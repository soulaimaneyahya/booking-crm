<template>
  <section class="w-1/2 mx-auto">
    <h3 class="mb-5 text-2xl font-medium dark:text-gray-300">Register</h3>
    <form @submit.prevent="register">
      <div class="mb-4">
        <label for="name" class="label">Name</label>
        <input id="name" v-model="form.name" type="text" class="input" />
        <div v-if="form.errors.name" class="input-error">{{ form.errors.name }}</div>
      </div>
      <div class="mb-4">
        <label for="username" class="label">Username</label>
        <input id="username" v-model="form.username" type="text" class="input" />
        <div v-if="form.errors.username" class="input-error">{{ form.errors.username }}</div>
      </div>
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
        <label for="password-confirmation" class="label">Confirm Password</label>
        <input id="password-confirmation" v-model="form.password_confirmation" type="password" class="input" />
        <div v-if="form.errors.password_confirmation" class="input-error">{{ form.errors.password_confirmation }}</div>
      </div>
      <div class="mb-4">
        <button class="btn-primary w-full" type="submit">Register</button>
      </div>
      <div class="mb-4">
        <Link :href="route('login')" class="text-dark-500 dark:text-gray-300 underline text-sm">Already have an account? Login</Link>
      </div>
    </form>
  </section>
</template>

<script setup>
/*global route*/
/*eslint no-undef: "error"*/
import { Link, useForm } from '@inertiajs/inertia-vue3'
const form = useForm({
  name: null,
  username: null,
  email: null,
  password: null,
  password_confirmation: null,
})
const register = () => form.post(route('register'))
</script>
