<template>
  <div>
    <h1>Create Product</h1>
    <form @submit.prevent="createProduct" class="mb-3">
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
      <button type="submit" class="btn btn-primary">Create</button>
      <router-link to="/" class="btn btn-secondary ms-2">Cancel</router-link>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useToast } from 'vue-toastification';

const name = ref('');
const description = ref('');
const price = ref(0);
const router = useRouter();
const toast = useToast();

const createProduct = async () => {
  try {
    const response = await axios.post('http://localhost:8000/api/product/store', {
      name: name.value,
      description: description.value,
      price: price.value,
    });

    if (response.status === 201) {
      toast.success('Продукт успешно создан!');

      await router.push({ name: 'home' });
    } else {
      toast.error('Ошибка при создании продукта: неверный ответ от сервера.');
    }
  } catch (error) {
    console.error('Error creating product:', error.response || error);
    toast.error('Ошибка при создании продукта.');
  }
};

</script>

<style scoped>
h1 {
  margin-bottom: 20px;
}
</style>
