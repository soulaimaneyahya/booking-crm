<template>
  <Box :class="{'opacity-50 font-normal line-through': listing.deleted_at}">
    <div>
      <Link
        :href="route('listings.show', listing.id)"
      >
        <Price :price="listing.price" class="text-2xl font-bold" />
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" class="text-gray-500" />
      </Link>
    </div>
  </Box>
</template>

<script setup>
import ListingAddress from '@/shared/Components/ListingAddress.vue'
import ListingSpace from '@/shared/Components/ListingSpace.vue'
import Price from '@/shared/Components/Price.vue'
import Box from '@/shared/Components/UI/Box.vue'
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  listing: Object,
})
</script>
