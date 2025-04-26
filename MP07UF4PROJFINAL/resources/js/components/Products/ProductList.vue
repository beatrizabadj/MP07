<template>
    <div>
        <h2>Products</h2>
        
        <div v-if="isAdmin" class="mb-3">
            <button @click="showCreateModal = true" class="btn btn-primary">Add Product</button>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th @click="sortBy('name')">Name</th>
                    <th>Description</th>
                    <th @click="sortBy('price')">Price</th>
                    <th v-if="isAdmin">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in sortedProducts" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.price }}</td>
                    <td v-if="isAdmin">
                        <button @click="editProduct(product)" class="btn btn-sm btn-warning">Edit</button>
                        <button @click="deleteProduct(product.id)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Create/Edit Modal -->
        <div v-if="showModal" class="modal fade show" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ editingProduct ? 'Edit Product' : 'Create Product' }}</h5>
                        <button @click="closeModal" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitForm">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input v-model="form.name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea v-model="form.description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input v-model="form.price" type="number" step="0.01" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
            sortField: 'name',
            sortDirection: 'asc',
            showModal: false,
            showCreateModal: false,
            editingProduct: null,
            form: {
                name: '',
                description: '',
                price: 0
            }
        }
    },
    computed: {
        isAdmin() {
            return this.$store.state.auth.user?.role?.name === 'admin';
        },
        sortedProducts() {
            return [...this.products].sort((a, b) => {
                let modifier = this.sortDirection === 'asc' ? 1 : -1;
                if (a[this.sortField] < b[this.sortField]) return -1 * modifier;
                if (a[this.sortField] > b[this.sortField]) return 1 * modifier;
                return 0;
            });
        }
    },
    watch: {
        showCreateModal(val) {
            if (val) {
                this.editingProduct = null;
                this.form = { name: '', description: '', price: 0 };
                this.showModal = true;
            } else {
                this.showModal = false;
            }
        }
    },
    async mounted() {
        await this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            try {
                const response = await axios.get('/api/products');
                this.products = response.data;
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        },
        sortBy(field) {
            if (this.sortField === field) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortField = field;
                this.sortDirection = 'asc';
            }
        },
        editProduct(product) {
            this.editingProduct = product;
            this.form = { ...product };
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
            this.showCreateModal = false;
        },
        async submitForm() {
            try {
                if (this.editingProduct) {
                    await axios.put(`/api/products/${this.editingProduct.id}`, this.form);
                } else {
                    await axios.post('/api/products', this.form);
                }
                await this.fetchProducts();
                this.closeModal();
            } catch (error) {
                console.error('Error saving product:', error);
            }
        },
        async deleteProduct(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                try {
                    await axios.delete(`/api/products/${id}`);
                    await this.fetchProducts();
                } catch (error) {
                    console.error('Error deleting product:', error);
                }
            }
        }
    }
}
</script>