import { defineStore } from 'pinia';
import axios from 'axios';
import { Product } from '../types/products';

export const useProductStore = defineStore('products', {
  state: () => ({
    products: [] as Product[],
    loading: false,
  }),
  actions: {
    async fetchProducts(filters: { product_name?: string; product_type?: string } = {}) {
      this.loading = true;
      try {
        const params = new URLSearchParams();
        if (filters.product_name) params.append('product_name', filters.product_name);
        if (filters.product_type) params.append('product_type', filters.product_type);
        const response = await axios.get('http://127.0.0.1:8000/api/products', { params });
        this.products = response.data;
      } finally {
        this.loading = false;
      }
    },
    async addProduct(product: Omit<Product, 'product_id' | 'parent' | 'children'>) {
      const response = await axios.post('http://127.0.0.1:8000/api/products', product);
      this.products.push(response.data);
    },
    async updateProduct(id: number, product: Partial<Product>) {
      const response = await axios.put(`http://127.0.0.1:8000/api/products/${id}`, product);
      const index = this.products.findIndex(p => p.product_id === id);
      if (index !== -1) this.products[index] = response.data;
    },
    async deleteProduct(id: number) {
      await axios.delete(`http://127.0.0.1:8000/api/products/${id}`);
      this.products = this.products.filter(p => p.product_id !== id);
    },
  },
});