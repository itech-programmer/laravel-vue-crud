<template>
  <div>
    <h1>Edit Product</h1>
    <div v-if="isLoading">Loading...</div>
    <div v-else>
      <form @submit.prevent="updateProduct" class="mb-3">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input id="name" v-model="name" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input id="description" v-model="description" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input id="price" type="number" v-model="price" class="form-control" required min="0" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <router-link to="/" class="btn btn-secondary ms-2">Cancel</router-link>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter, useRoute } from 'vue-router';
import { useToast } from 'vue-toastification';

const name = ref('');
const description = ref('');
const price = ref(0);
const isLoading = ref(true);
const router = useRouter();
const route = useRoute();
const toast = useToast();

onMounted(async () => {
  try {
    const response = await axios.get(`http://localhost:8000/api/product/${route.params.id}/edit`);
    const product = response.data;
    name.value = product.name;
    description.value = product.description;
    price.value = product.price;
  } catch (error) {
    console.error('Error fetching product:', error);
    toast.error('Ошибка при загрузке продукта.');
  } finally {
    isLoading.value = false;
  }
});

const updateProduct = async () => {
  try {
    await axios.put(`http://localhost:8000/api/product/${route.params.id}/update`, {
      name: name.value,
      description: description.value,
      price: price.value,
    });
    toast.success('Продукт успешно обновлен!');
    await router.push({ name: 'home' });
  } catch (error) {
    console.error('Error updating product:', error);
    toast.error('Ошибка при обновлении продукта.');
  }
};
</script>

<style scoped>
h1 {
  margin-bottom: 20px;
}
</style>
