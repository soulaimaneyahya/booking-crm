<template>
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4">
      <Form :form="form" />
      <div class="col-span-6">
        <button type="submit" class="btn-primary">Create</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import Form from '@/shared/Components/Form.vue'

const form = useForm({
  beds: 0,
  baths: 0,
  area: 0,
  city: null,
  street: null,
  code: null,
  street_nr: null,
  price: 0,
})
const create = () => form.post(route('realtor.listings.store'))
</script>

<style scoped>
label {
  margin-right: 2em;
}
div {
  padding: 2px
}
</style>
