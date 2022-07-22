<template>
    <div style="display: flex; justify-content: center">
        <div style="width: 80%">
            <el-form label-position="top" inline>
                <el-form-item label="Name">
                    <el-input v-model.trim="filters.name"
                              placeholder="Type to search by name"
                              clearable/>
                </el-form-item>
                <el-form-item label="Price">
                    <el-input-number v-model="filters.price[0]"
                                     placeholder="min" @input="onChangeFilter">
                    </el-input-number>
                    <el-input-number v-model="filters.price[1]"
                                     placeholder="max" @input="onChangeFilter">
                    </el-input-number>

                    <el-icon v-if="filters.price.length > 1" @click="filters.price = []">
                        <CircleClose/>
                    </el-icon>
                </el-form-item>
                <el-form-item label="Bedrooms">
                    <el-input-number v-model="filters.bedrooms"
                                     @input="onChangeFilter"
                                     style="margin-right: 10px">
                    </el-input-number>

                    <el-icon v-if="filters.bedrooms !== undefined" @click="filters.bedrooms = undefined">
                        <CircleClose/>
                    </el-icon>
                </el-form-item>
                <el-form-item label="Bathrooms">
                    <el-checkbox/>

                    <el-input-number v-model="filters.bathrooms"
                                     style="margin-left: 10px">
                    </el-input-number>

                    <el-icon v-if="filters.bathrooms !== undefined" @click="filters.bathrooms = undefined">
                        <CircleClose/>
                    </el-icon>
                </el-form-item>

                <el-form-item label="Storeys">
                    <el-input-number v-model="filters.storeys"
                                     @input="onChangeFilter"
                                     style="margin-left: 10px">
                    </el-input-number>

                    <el-icon v-if="filters.storeys !== undefined" @click="filters.storeys = undefined">
                        <CircleClose/>
                    </el-icon>
                </el-form-item>
                <el-form-item label="Garages">
                    <el-input-number v-model="filters.garages"
                                     @input="onChangeFilter"
                                     style="margin-left: 10px">
                    </el-input-number>

                    <el-icon v-if="filters.garages !== undefined" @click="filters.garages = undefined">
                        <CircleClose/>
                    </el-icon>
                </el-form-item>
            </el-form>
            <br>
            <el-table :data="tableData" v-loading="loading">
                <el-table-column prop="name" label="Mame" width="180"/>
                <el-table-column prop="price" label="Price"/>
                <el-table-column prop="bedrooms" label="Bedrooms"/>
                <el-table-column prop="bathrooms" label="Bathrooms"/>
                <el-table-column prop="storeys" label="Storeys"/>
                <el-table-column prop="garages" label="Garages"/>
            </el-table>
        </div>
    </div>
</template>

<script>
import debounce from 'lodash.debounce'

export default {
    name: "Index",
    data() {
        return {
            filters: {price: []},
            tableData: [],
            loading: false
        }
    },
    mounted() {
        this.fetch();
    },
    computed: {
        onChangeFilter() {
            return debounce(this.fetch, 100)
        },
    },

    methods: {
        fetch() {
            this.loading = true;

            axios.get(route('apartments-get'), {params: this.filters}).then(({data}) => {
                this.tableData = data
            }).finally(() => this.loading = false)

        }
    },
    watch: {
        filters: {
            immediate: true,
            deep: true,
            handler() {
                this.fetch();
            }
        }
    }
}
</script>
