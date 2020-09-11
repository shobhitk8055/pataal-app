<template>
    <div class="container">
        <form class="form" method="post" action="discount">
            <label for="discount"> Discount (Rs)</label>
            <input type="hidden" name="_token" v-bind:value="csrf">
            <input type="hidden" name="bookingId" v-bind:value="book">
            <input v-model.number="amount" id="discount" style="margin-left:10px;" placeholder="10" class="pl-3" type="number" name="discount">
            <button v-bind:disabled="amount > sum || amount < 0" style="margin-left:10px;" class="btn-success" type="submit">Submit</button>
        </form>
        <p class="alert alert-danger" v-if="amount > sum"> Discount can't be more than the total amount</p>
        <p class="alert alert-danger" v-if="amount < 0"> Discount can't be negative</p>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                amount:null
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        props: ['sum', 'csrf', 'book']
    }
</script>
