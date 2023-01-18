<template>
  <form @submit.prevent="update">
    <div class="grid grid-cols-6 gap-4">
      <Form :form="form" />
      <div class="col-span-6">
        <button type="submit" class="btn-primary">Update</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import Form from '@/shared/Components/Form.vue'

const props = defineProps({
  listing: Object,
})
const form = useForm({
  beds: props.listing.beds,
  baths: props.listing.baths,
  area: props.listing.area,
  city: props.listing.city,
  street: props.listing.street,
  code: props.listing.code,
  street_nr: props.listing.street_nr,
  price: props.listing.price,
})

const update = () => form.put(route('realtor.listings.update', props.listing.id))
</script>

<style scoped>
label {
  margin-right: 2em;
}
div {
  padding: 2px
}
</style>
