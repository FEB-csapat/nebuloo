<template>
        <div class="row bg-light rounded-4 mb-3 shadow">
            <p>
                {{ticket.body}}
            </p>
            <h6 class="text-end">State: {{ ticket.state }}</h6>
        </div>
</template>

<script>
export default{
    props:{
        ticket: Object
    }
}
</script>