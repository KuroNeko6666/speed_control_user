<script>
    events = ['livewire:load', 'update']
    events.forEach(event => {
        document.addEventListener(event, function(e) {
            register = null
            monthly = null
            daily_speed = null
            daily_speed_monthly = null

            if (e.detail != undefined) {
                register = e.detail.daily_register;
                monthly = e.detail.monthly_register;
                daily_speed = e.detail.daily_speed;
                monthly_speed = e.detail.monthly_speed;
            } else {
                register = @json($data_register);
                monthly = @json($monthly_register);
                daily_speed = @json($daily_speed);
                monthly_speed = @json($monthly_speed);
            }
            console.log(daily_speed);
        })
    });
</script>
