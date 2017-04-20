<template>
    <div>
        <el-table
                :data="data.data"
                style="width: 100%">
            <el-table-column type="expand">
                <template scope="props">
                    <el-form label-position="left" inline class="demo-table-expand">
                        <el-form-item label="商品名称" show-overflow-tooltip>
                            <span>{{ props.row.name }}</span>
                        </el-form-item>
                        <el-form-item label="现有库存">
                            <span>{{ props.row.number }}</span>
                        </el-form-item>
                        <el-form-item label="商品 ID">
                            <span>{{ props.row.id }}</span>
                        </el-form-item>
                        <el-form-item label="成本">
                            <span>{{ props.row.cost_price }}元</span>
                        </el-form-item>
                        <el-form-item label="现价">
                            <span>{{ props.row.now_price }}元</span>
                        </el-form-item>
                        <el-form-item label="在首页显示" style="color:red;" v-if="props.row.is_show">
                        </el-form-item>
                        <el-form-item label="商品描述" show-overflow-tooltip>
                            <span>{{ props.row.description }}</span>
                        </el-form-item>
                    </el-form>
                </template>
            </el-table-column>
            <el-table-column
                    label="商品 ID"
                    prop="id"
                    width="150">
            </el-table-column>
            <el-table-column
                    label="商品名称"
                    prop="name"
                    show-overflow-tooltip>
            </el-table-column>
            <el-table-column
                    label="描述"
                    prop="description"
                    show-overflow-tooltip>
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
                    width="160">
                <template scope="scope">
                    <el-button
                            @click.native.prevent="deleteRow(scope.$index, data)"
                            type="text"
                            size="small">
                        删除
                    </el-button>
                    <el-button
                            @click.native.prevent="showRow(scope.$index, data)"
                            type="text"
                            size="small">
                        查看
                    </el-button>
                    <el-button
                            @click.native.prevent="editRow(scope.$index, data)"
                            type="text"
                            size="small">
                        编辑
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
                :current-page="data.current_page"
                :page-size="10"
                layout="total, prev, pager, next, jumper"
                :total="data.total">
        </el-pagination>

    </div>
</template>

<script>
    export default {
        methods: {
            handleClick(){

            },
            handleSizeChange(val)
            {
                axios.get('/api/item', {
                    params: {
                        page_size: val
                    }
                }).then(res => {
                    this.data = res.data
                })
            }
            ,
            handleCurrentChange(val)
            {
                axios.get('/api/item', {
                    params: {
                        page: val,
                        page_size: this.data.per_page
                    }
                }).then(res => {
                    this.data = res.data
                })
            },
            deleteRow(index, row){
                this.$confirm('此操作将永久删除该商品, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.delete('/api/item/' +
                        this.data.data[index].id).then(res => {
                        if (res.data.code != 0) {
                            this.$notify({
                                title: '删除成功',
                                message: '商品移除成功',
                                type: 'success'
                            });
                            this.data = res.data
                        } else if (res.data.code == 0) {
                            this.$notify({
                                title: '删除失败',
                                message: res.data.err_msg,
                                type: 'error'
                            });
                        }
                    }).catch(err => {
                        this.$notify({
                            title: '删除失败',
                            message: res.data.err_msg,
                            type: 'error'
                        });
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            showRow(index, row){
                this.$router.push({name: 'detail', params: {itemId: this.data.data[index].id}})
            },
            editRow(index, row){
                this.$router.push({name: 'item_edit', params: {itemId: this.data.data[index].id}})
            }
        },
        data() {
            return {
                data: []
            }
        },
        created(){
            axios.get('/api/item').then(res => {
                this.data = res.data
            })
        }
    }
</script>

<style>

</style>