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
            axios.get('/admin/test').then(res => {
                console.log(res)
            })
        }
    }
</script>