<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <FullCalendar :options="calendarOptions"
                              @clickEvent="handleEventClick"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import interactionPlugin from '@fullcalendar/interaction'

    export default {
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        data() {
            return {
                calendarOptions: {
                    plugins: [ dayGridPlugin, interactionPlugin ],
                    initialView: 'dayGridMonth',
                    dateClick: this.handleDateClick,
                    eventClick: this.eventClick,
                    events: this.getBookings()
                },
                book : this.getRooms(1)
            }
        },
        methods: {
            handleDateClick: function(arg) {
                alert('date click! ' + arg.dateStr)
            },
            eventClick: function(info) {
                var title = info.event._def.title;
                var pos = title.search(":")+2;
                var length = title.length-pos;
                var booking_id = title.substr(pos,length);

                window.location.href = "bookings/"+booking_id;
            },
            getBookings: function () {
                var bookings = JSON.parse(this.booking);
                var event =[];
                for (var i=0; i<bookings.length; i++){
                    event.push({
                        'title':this.getRooms(bookings[i].room_id)+" : " + bookings[i].id,
                        'start':bookings[i].time_from,
                        'end':bookings[i].time_to,
                    })
                }
                return event;
            },
            getRooms: function (id) {
                var rooms = JSON.parse(this.room);
                for (var i=0;i<rooms.length;i++){
                    if(rooms[i].id === id){
                        return rooms[i].room_number;
                    };
                }
                return rooms;
            }
        },
        props: ['booking','room']
    }
</script>
