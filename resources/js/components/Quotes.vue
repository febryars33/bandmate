<template>
    <div v-if="show" class="card widget-card border-light shadow-sm">
        <div class="card-body">
            <figure class="m-0">
                <blockquote class="blockquote">
                    <p>{{ quote.quote }}</p>
                </blockquote>
                <figcaption class="blockquote-footer mb-0">
                    <cite title="Source Title">{{ quote.author }}</cite>
                </figcaption>
            </figure>
        </div>
    </div>
</template>

<script lang="ts" setup>
import axios from 'axios'
import { ref } from 'vue';

type Quote = {
    id: number,
    quote: string,
    author: string
}

const show = ref(false)

const quote = ref({
    id: 0,
    quote: '',
    author: ''
})

axios.get<Quote>('https://dummyjson.com/quotes/random')
    .then((response) => {
        const data: Quote = response.data
        quote.value = data
        show.value = true
    }).catch((error) => {
        console.log(error)
        show.value = false
    })
</script>
