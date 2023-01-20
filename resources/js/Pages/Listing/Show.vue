<template>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box v-if="listing.images.length" class="md:col-span-7 flex items-center">
      <div class="grid grid-cols-2 gap-1">
        <img
          v-for="image in listing.images" :key="image.id"
          :src="image.src"
        />
      </div>
    </Box>
    <EmptyState v-else class="md:col-span-7 flex items-center">No Images</EmptyState>
    <div class="md:col-span-5 flex flex-col gap-4">
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
        <Price :price="listing.price" class="text-2xl font-bold" />
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" class="text-gray-500" />
      </Box>

      <Box>
        <template #header>Monthly Payment</template>
        <div>
          <label class="label">Interest rate ({{ interestRate }}%)</label>
          <input
            v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />

          <label class="label">Duration ({{ duration }} years)</label>
          <input
            v-model.number="duration" type="range" min="3" max="35" step="1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />

          <div class="text-gray-600 dark:text-gray-300 mt-2">
            <div class="text-gray-400">Your monthly payment</div>
            <Price :price="monthlyPayment" class="text-3xl" />
          </div>

          <div class="mt-2 text-gray-500">
            <div class="flex justify-between">
              <div>Total paid</div>
              <div>
                <Price :price="totalPaid" class="font-medium" />
              </div>
            </div>
            <div class="flex justify-between">
              <div>Principal paid</div>
              <div>
                <Price :price="listing.price" class="font-medium" />
              </div>
            </div>
            <div class="flex justify-between">
              <div>Interest paid</div>
              <div>
                <Price :price="totalInterest" class="font-medium" />
              </div>
            </div>
          </div>
        </div>
      </Box>

      <MakeOffer 
        v-if="user && !offerMade"
        :listing-id="listing.id"
        :price="listing.price"
        @offer-updated="offer = $event"
      />
      <OfferMade v-else-if="user && offerMade" :offer="offerMade" />
      <Link v-else class="mt-2 w-full text-center underline" :href="route('login')">Signin in order to make an offer</Link>
    </div>
  </div>
</template>

<script setup>
import ListingAddress from '@/shared/Components/ListingAddress.vue'
import ListingSpace from '@/shared/Components/ListingSpace.vue'
import Price from '@/shared/Components/Price.vue'
import Box from '@/shared/Components/UI/Box.vue'
import MakeOffer from '@/Pages/Listing/Components/MakeOffer.vue'
import OfferMade from '@/Pages/Listing/Components/OfferMade.vue'
import EmptyState from '@/shared/Components/UI/EmptyState.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

import { useMonthlyPayment } from '@/shared/utils/useMonthlyPayment'
import { ref } from 'vue'

const props = defineProps({
  listing: Object,
  offerMade: Object,
})

const interestRate = ref(2.5)
const duration = ref(25)

const page = usePage()
const user = computed(
  () => page.props.value.user,
)

const offer = ref(props.listing.price)

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
  offer,
  interestRate,
  duration,
)
</script>
