<template>
    <div>
        <el-tabs type="border-card" active-name="info">
            <el-tab-pane name="info" label="增加商品信息">
                <add-item-info></add-item-info>
            </el-tab-pane>
        </el-tabs>
    </div>

</template>

<script>
    import AddItemInfo from './addItemInfo.vue'
    export default{
        components: {
            AddItemInfo
        }
    }
</script>