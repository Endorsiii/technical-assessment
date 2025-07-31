<template>
  <q-page class="q-pa-md">
    <h1>Products</h1>
    <q-form @submit="addOrUpdateProduct">
      <q-input v-model="form.product_name" label="Product Name" filled />
      <q-input v-model="form.product_type" label="Product Type" filled />
      <q-select
        v-model="form.product_parent_id"
        :options="parentOptions"
        label="Parent Product"
        filled
        clearable
      />
      <q-btn type="submit" color="primary" :label="editing ? 'Update' : 'Add'" />
    </q-form>
    <q-input v-model="filter.product_name" label="Filter by Name" debounce="300" />
    <q-input v-model="filter.product_type" label="Filter by Type" debounce="300" />
    <q-list v-if="!store.loading">
      <q-item v-for="product in store.products" :key="product.product_id">
        <q-item-section>
          {{ product.product_name }} ({{ product.product_type }})
          <div v-if="product.children?.length">
            <q-list dense>
              <q-item v-for="child in product.children" :key="child.product_id">
                <q-item-section>
                  - {{ child.product_name }} ({{ child.product_type }})
                </q-item-section>
              </q-item>
            </q-list>
          </div>
        </q-item-section>
        <q-item-section side>
          <q-btn flat icon="edit" @click="editProduct(product)" />
          <q-btn flat icon="delete" @click="deleteProduct(product.product_id)" />
        </q-item-section>
      </q-item>
    </q-list>
    <q-spinner v-else />
  </q-page>
</template>

<script setup lang="ts">
import { ref, computed, watch } from 'vue';
import { useProductStore } from '../stores/products';
import { Product } from '../types/products';

const store = useProductStore();
const form = ref({ product_name: '', product_type: '', product_parent_id: null as number | null });
const filter = ref({ product_name: '', product_type: '' });
const editing = ref(false);
const editingId = ref<number | null>(null);

const parentOptions = computed(() =>
  store.products.map(p => ({ label: p.product_name, value: p.product_id }))
);

store.fetchProducts();

watch(filter.value, () => store.fetchProducts(filter.value), { deep: true });

const addOrUpdateProduct = async () => {
  if (editing.value && editingId.value) {
    await store.updateProduct(editingId.value, form.value);
  } else {
    await store.addProduct(form.value);
  }
  resetForm();
};

const editProduct = (product: Product) => {
  form.value = { ...product };
  editing.value = true;
  editingId.value = product.product_id;
};

const deleteProduct = async (id: number) => {
  await store.deleteProduct(id);
};

const resetForm = () => {
  form.value = { product_name: '', product_type: '', product_parent_id: null };
  editing.value = false;
  editingId.value = null;
};
</script>