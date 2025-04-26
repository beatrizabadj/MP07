<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form @submit.prevent="submitForm">
                    <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input v-model="form.name" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input v-model="form.email" type="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input v-model="form.password" type="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input v-model="form.password_confirmation" type="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            error:null
        }
    },
     methods: {
        async submitForm() {
        if (this.form.password !== this.form.password_confirmation) {
            this.error = 'Passwords do not match';
            return;
        }

        try {
            const success = await this.$store.dispatch('auth/register', this.form);
            if (success) {
            this.$router.push('/products');
            }
        } catch (error) {
            if (error.response && error.response.data.errors) {
            // Manejar errores de validación
            this.error = Object.values(error.response.data.errors).flat().join(', ');
            } else {
            this.error = 'Registration failed. Please try again.';
            }
      }
    }
  }
}
</script>