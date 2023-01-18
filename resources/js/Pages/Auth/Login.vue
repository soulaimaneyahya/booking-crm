<template>
  <section class="w-1/2 mx-auto">
    <h3 class="mb-5 text-2xl font-medium dark:text-gray-300">Login</h3>
    <form @submit.prevent="login">
      <div class="mb-4">
        <label for="email" class="label">E-mail Address</label>
        <input id="email" v-model="form.email" type="email" class="input" />
        <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
      </div>
      <div class="mb-4">
        <label for="password" class="label">Password</label>
        <input id="password" v-model="form.password" type="password" class="input" />
        <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
      </div>
      <div class="mb-4">
        <button class="btn-primary w-full" type="submit">Login</button>
      </div>
      <div class="mb-4">
        <Link :href="route('register')" class="text-dark-500 dark:text-gray-300 underline text-sm">Don't have an account yet? Register</Link>
      </div>
    </form>
  </section>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3'
const form = useForm({
  email: null,
  password: null,
})
const login = () => form.post(route('login'))
</script>
