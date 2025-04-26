<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Product Manager</a>
                <div class="navbar-nav">
                    <template v-if="!isAuthenticated">
                        <router-link to="/login" class="nav-link">Login</router-link>
                        <router-link to="/register" class="nav-link">Register</router-link>
                    </template>
                    <template v-else>
                        <button @click="logout" class="nav-link btn btn-link">Logout</button>
                    </template>
                </div>
            </div>
        </nav>

        <router-view></router-view>
    </div>
</template>

<script>
export default {
    computed: {
        isAuthenticated() {
            return this.$store.state.auth.isAuthenticated;
        }
    },
    methods: {
        async logout() {
            try {
                await this.$store.dispatch('auth/logout');
                this.$router.push('/login');
            } catch (error) {
                console.error('Logout failed:', error);
            }
        }
    },
    created() {
        this.$store.dispatch('auth/initialize');
    }
}
</script>