<template>
  <span>
    {{ listing.street }} {{ listing.street_nr }}, {{ listing.city }}
    <span>, Added {{ createdAtDiff }}</span>
  </span>
</template>

<script setup>
import moment from 'moment'
import { computed } from 'vue'

const props = defineProps({
  listing: Object,
})

const createdAtDiff = computed(() => {
  return moment(props.listing.created_at).fromNow()
})

// by <span class="font-semibold">{{ listing.owner.name }}</span>
</script>
