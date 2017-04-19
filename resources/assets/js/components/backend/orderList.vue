<template>
    <div>

        <el-table
                :data="data.data"
                border
                style="width: 100%"
                max-height="800">
            <el-table-column
                    fixed
                    prop="order_id"
                    label="订单ID"
                    width="150">
            </el-table-column>
            <el-table-column
                    prop="user.0.id"
                    label="用户ID"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="user.0.name"
                    label="用户名"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="address.0.address"
                    label="快递地址"
                    width="240">
            </el-table-column>
            <el-table-column
                    prop="max_num.name"
                    label="商品名"
                    width="240">
            </el-table-column>
            <el-table-column
                    prop="item_number"
                    label="商品数量"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="total_price"
                    label="商品总价"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="kd_company"
                    label="快递公司"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="kd_code"
                    label="快递单号"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="new_status"
                    label="状态"
                    width="120">
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
                    width="240">
                <template scope="scope">
                    <el-button
                            @click.native.prevent="deleteRow(scope.$index,data.data)"
                            type="text"
                            size="small">
                        移除
                    </el-button>
                    <el-button
                            @click="enterKdCode(scope.$index, data.data)"
                            type="text"
                            size="small">
                        输入快递单号
                    </el-button>
                    <el-button
                            @click="Consignment(scope.$index, data.data)"
                            type="text"
                            size="small">
                        发货
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination
                @current-change="handleCurrentChange"
                :current-page="data.current_page"
                layout="total, prev, pager, next, jumper"
                :total="data.total">
        </el-pagination>
        <el-button
                @click="notShowNew"
                type="primary"
        >
            不显示为下单订单
        </el-button>

    </div>
</template>

<script>
    export default {
        methods: {
            deleteRow(index, rows) {
                this.$confirm('此操作将永久删除该订单, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.delete('/api/order/' +
                        this.data.data[index].order_id).then(res => {
                        this.$notify({
                            title: '移除成功',
                            message: '订单移除成功',
                            type: 'success'
                        });
                        rows.splice(index, 1);
                    }).catch(err => {
                        this.$notify({
                            title: '移除失败',
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
            enterKdCode(index, rows){
                this.$prompt('请输入快递单号', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                }).then(({value}) => {
                        axios.put('/api/order/' + this.data.data[index].order_id + "?kd_code=" + value + "&status=kd_code")
                            .then(res => {
                                console.log(res.data.code)
                                if (res.data.code != 0) {
                                    this.$message({
                                        type: 'success',
                                        message: '快递单号是: ' + value
                                    })
                                } else if(res.data.code == 0) {
                                    this.$notify({
                                        title: '失败',
                                        message: res.data.err_msg,
                                        type: 'error'
                                    });
                                }
                            }).catch(err => {
                            this.$notify({
                                title: '失败',
                                message: res.data.err_msg,
                                type: 'error'
                            });
                        })
                    }
                ).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '取消输入'
                    });
                });
            },
            notShowNew()
            {
                axios.get('/api/order', {
                    params: {
                        page: this.data.current_page,
                        page_size: this.data.per_page,
                        not_show_new: true
                    }
                }).then(res => {
                    this.data = res.data
                })
            }
            ,
            handleSizeChange(val)
            {
                axios.get('/api/order', {
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
                axios.get('/api/order', {
                    params: {
                        page: val,
                        page_size: this.data.per_page
                    }
                }).then(res => {
                    this.data = res.data
                })
            }
            ,
            //done
            Consignment(index, rows)
            {
                this.$confirm('请确认用户已付款?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    axios.put('/api/order/' +
                        this.data.data[index].order_id + "?status=send").then(res => {
                        if (res.data.code == '0') {
                            this.$notify({
                                title: '发货失败',
                                message: res.data.err_msg,
                                type: 'error'
                            });
                        } else {
                            this.data = res.data
                            this.$notify({
                                title: '发货成功',
                                message: '订单发货成功',
                                type: 'success'
                            });

                        }
                    }).catch(err => {
                        this.$notify({
                            title: '发货失败',
                            message: res.data.err_msg,
                            type: 'error'
                        });
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消'
                    });
                });

            },
        },
        data()
        {
            return {
                data: [],
                gridData: [{
                    date: '2016-05-02',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-04',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-01',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }]
            }
        }
        ,
        created()
        {
            axios.get('/api/order').then(res => {
                this.data = res.data
            })
        }
    }
</script>