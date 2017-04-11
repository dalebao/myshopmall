<template>
    <div>

    </div>
</template>

<script>
    export default{
        data(){
            return {
                itemId:'',
                userId:''
            }
        },
        created(){
            this.itemId = this.$route.params.itemId
            this.userId = sessionStorage.getItem('user-id')
            console.log(this.itemId)
            console.log(this.userId)
        }
    }
</script>