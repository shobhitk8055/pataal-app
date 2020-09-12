<template>

<div>
    <div class="form" v-if="!booking.payment_status">
        <h4 class="mb-4">Add payment</h4>
        <form method="post" action="payment" style="margin-top:10px;">

            <input type="hidden" v-bind:value="csrf" name="_token">
            <input type="hidden" v-bind:value="booking.id" name="bookingId">
            <input type="hidden" value="1" name="payment_status">
            <input type="hidden" value="0" name="time">


            <label for="payment_mode">Payment Mode</label>
            <select class="form-control" v-model="mode" name="mode">
                <option value="credit">credit card</option>
                <option value="debit">debit card</option>
                <option value="google_pay">google pay</option>
                <option value="phone_pay">phone pay</option>
                <option value="upi">UPI</option>
                <option value="paytm">Paytm</option>
            </select>

            <div v-if="mode === 'credit' || mode === 'debit'" style="margin-top:10px;">
                <label for="card_no">Card Number (last 4 digit)</label>
                <input id="card_no"  type="number" name="card_no" class="form-control">
            </div>

            <div v-if="mode === 'google_pay' || mode === 'phone_pay' || mode === 'upi'" style="margin-top:10px;">
                <label for="upi">UPI Id</label>
                <input id="upi" type="string" name="upi_id" class="form-control">
            </div>

            <div v-if="mode === 'paytm'" style="margin-top:10px;">
                <label for="paytm">Paytm number</label>
                <input id="paytm" type="string" name="paytm_no" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top:10px;">Add</button>

        </form>
    </div>
    <div class="payment" style="margin-top:10px;">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Payment Status</th>
                <td scope="col">{{ booking.payment_status === 0 ? 'Pending':'Approved' }}</td>
            </tr>
            </thead>
            <tbody v-if="booking.status">

            <tr>
                <th scope="row">Mode</th>
                <td>{{ booking.mode }}</td>
            </tr>
            <tr v-if="booking.mode==='credit'||booking.mode==='debit'">
                <th scope="row">Last 4 digit</th>
                <td>{{ booking.card_no }}</td>
            </tr>
            <tr v-if="booking.mode==='upi'||booking.mode==='google_pay'||booking.mode==='phone_pay'">
                <th scope="row">UPI ID</th>
                <td>{{ booking.upi_id }}</td>
            </tr>
            <tr v-if="booking.mode==='paytm'">
                <th>Paytm Number</th>
                <td>{{ booking.paytm_no }}</td>
            </tr>
            <tr>
                <th>Payment time</th>
                <td>{{ booking.time }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                amount:null,
                mode:"credit",
                booking: JSON.parse(this.book)
            }
        },
        mounted() {
            console.log(this.book)
        },
        props: ['sum', 'csrf', 'book']
    }
</script>
