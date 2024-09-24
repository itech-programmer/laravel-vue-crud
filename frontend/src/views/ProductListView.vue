<template>
  <div>
    <h1>Products</h1>
    <button @click="goToCreate" class="btn btn-primary mb-3">Create Product</button>
    <div v-if="isLoading">Loading...</div>
    <ul v-else class="list-group">
      <li
          v-for="product in products"
          :key="product.id"
          class="list-group-item d-flex justify-content-between align-items-center">
        <span>
          {{ product.name }} - {{ product.price }} USD
        </span>
        <span>
          <button @click="goToEdit(product.id)" class="btn btn-warning btn-sm">Edit</button>
          <button @click="deleteProduct(product.id)" class="btn btn-danger btn-sm">Delete</button>
        </span>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useToast } from 'vue-toastification';

const products = ref([]);
const isLoading = ref(true);
const router = useRouter();
const toast = useToast();

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/products/index');
    products.value = response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
    toast.error('Ошибка при загрузке продуктов.');
  } finally {
    isLoading.value = false;
  }
});

const goToCreate = () => {
  router.push({ name: 'product-create' });
};

const goToEdit = (id) => {
  router.push({ name: 'product-edit', params: { id } });
};

const deleteProduct = async (id) => {
  const confirmDelete = confirm('Вы уверены, что хотите удалить этот продукт?');
  if (!confirmDelete) return;

  try {
    await axios.delete(`http://localhost:8000/api/product/${id}/destroy`);
    products.value = products.value.filter(product => product.id !== id);
    toast.success('Продукт успешно удален.');
  } catch (error) {
    console.error('Error deleting product:', error);
    toast.error('Ошибка при удалении продукта.');
  }
};

</script>

<style scoped>
h1 {
  margin-bottom: 20px;
}
</style>
