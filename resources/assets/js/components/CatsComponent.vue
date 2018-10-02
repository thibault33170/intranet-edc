<template>
    <div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group col-md-6 col-md-offset-3">
                    <input type="text" class="form-control" placeholder="Search" v-model="search">
                </div>
            </div>
        </div>
        <div class="row">
            <div v-for="cat in filteredCats">
                <a style="text-decoration: none; color: grey" :href="'/cats/' + cat.id">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1>{{ cat.name }}</h1>
                                <h5>{{ formatedDate(cat.dob) }}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: ['cats'],

        data() {
            return {
                search: ''
            }
        },

        methods: {
            formatedDate: (date) => {
                let now = moment()
                let current = moment(date)

                return current.from(now)
            }
        },

        computed: {
            filteredCats() {
                return this.cats.filter(cat => {
                    if (this.search === '')
                        return cat

                    return cat.name.toLowerCase().indexOf(this.search.toLowerCase()) >= 0
                })
            }
        }
    }
</script>
