<template>
    <div>
        ssss
    </div>
</template>

<script>
    export default{
        data(){
            return {
                data: ''
            }
        },
        created(){
            axios.get('/test').then(res => {
                console.log(res)
            })
        }
    }
</script>