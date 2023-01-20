<template>
  <div class="col-span-2">
    <label class="label">Beds</label>
    <input v-model.number="formulaire.beds" type="text" class="input" />
    <div v-if="formulaire.errors.beds" class="input-error">
      {{ formulaire.errors.beds }}
    </div>
  </div>

  <div class="col-span-2">
    <label class="label">Baths</label>
    <input v-model.number="formulaire.baths" type="text" class="input" />
    <div v-if="formulaire.errors.baths" class="input-error">
      {{ formulaire.errors.baths }}
    </div>
  </div>

  <div class="col-span-2">
    <label class="label">Area</label>
    <input v-model.number="formulaire.area" type="text" class="input" />
    <div v-if="formulaire.errors.area" class="input-error">
      {{ formulaire.errors.area }}
    </div>
  </div>

  <div class="col-span-4">
    <label class="label">City</label>
    <input v-model="formulaire.city" type="text" class="input" />
    <div v-if="formulaire.errors.city" class="input-error">
      {{ formulaire.errors.city }}
    </div>
  </div>

  <div class="col-span-2">
    <label class="label">Post Code</label>
    <input v-model="formulaire.code" type="text" class="input" />
    <div v-if="formulaire.errors.code" class="input-error">
      {{ formulaire.errors.code }}
    </div>
  </div>

  <div class="col-span-4">
    <label class="label">Street</label>
    <input v-model="formulaire.street" type="text" class="input" />
    <div v-if="formulaire.errors.area" class="input-error">
      {{ formulaire.errors.street }}
    </div>
  </div>

  <div class="col-span-2">
    <label class="label">Street Nr</label>
    <input v-model.number="formulaire.street_nr" type="text" class="input" />
    <div v-if="formulaire.errors.street_nr" class="input-error">
      {{ formulaire.errors.street_nr }}
    </div>
  </div>

  <div class="col-span-6">
    <label class="label">Price</label>
    <input v-model.number="formulaire.price" type="text" class="input" />
    <div v-if="formulaire.errors.price" class="input-error">
      {{ formulaire.errors.price }}
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
const props = defineProps({
  form: Object,
})

let formulaire = reactive(props.form)
</script>
