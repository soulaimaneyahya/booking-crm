<template>
  <div class="mb-4">
    <Link 
      :href="route('realtor.listings.index')"
    >
      ← Go back to Listings
    </Link>
  </div>

  <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
      <div class="w-full text-center font-medium text-gray-500">
        No offers
      </div>
    </Box>

    <div v-else class="md:col-span-7 flex flex-col gap-4">
      <Offer
        v-for="offer in listing.offers" 
        :key="offer.id"
        :offer="offer"
        :listing-price="listing.price"
        :is-sold="listing.sold_at != null"
      />
    </div>
    <div class="md:col-span-5">
      <Box>
        <template #header>
          <div class="flex items-center justify-between">
            <div>Basic Info</div>
            <div
              v-if="listing.sold_at != null"
            >
              <span class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md">sold</span>
            </div>
          </div>
        </template>
        <Price 
          :price="listing.price"
          class="text-2xl font-bold"
        />

        <ListingSpace 
          :listing="listing"
          class="text-lg"
        />
        <ListingAddress 
          :listing="listing"
          class="text-gray-500"
        />
      </Box>
    </div>
  </section>
</template>

<script setup>
import ListingSpace from '@/shared//Components/ListingSpace.vue'
import ListingAddress from '@/shared//Components/ListingAddress.vue'
import Price from '@/shared/Components/Price.vue'
import Box from '@/shared/Components/UI/Box.vue'
import Offer from '@/Pages/Realtor/Components/Offer.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
const props = defineProps({ listing: Object })
    
const hasOffers = computed(
  () => props.listing.offers.length,
)
</script>
