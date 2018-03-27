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
            <div v-for="capture in filteredCaptures">
                <a style="text-decoration: none; color: grey" :href="'/captures/' + capture.id">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1>{{ capture.city }}</h1>
                                <h5>{{ formatedDate(capture.date) }}</h5>
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
        props: ['captures'],

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
            filteredCaptures() {
                return this.captures.filter(capture => {
                    if (this.search === '')
                        return capture

                    return capture.city.toLowerCase().indexOf(this.search.toLowerCase()) >= 0
                })
            }
        }
    }
</script>
