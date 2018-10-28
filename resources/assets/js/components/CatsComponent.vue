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
            <div class="col-md-6 col-md-offset-3">
                <div class="form-inline text-center">
                    <div class="form-group" style="margin: 20px;">
                        <label for="toAdopt">A adopter</label>
                        <input type="radio" id="toAdopt" value="to adopt" v-model="state" name="state">
                    </div>

                    <div class="form-group" style="margin: 20px;">
                        <label for="toReserve">A réserver</label>
                        <input type="radio" id="toReserve" value="to reserve" v-model="state" name="state">
                    </div>

                    <div class="form-group" style="margin: 20px;">
                        <label for="adopted">Adopté</label>
                        <input type="radio" id="adopted" value="adopted" v-model="state" name="state">
                    </div>

                    <div class="form-group" style="margin: 20px;">
                        <label for="reserved">Réservé</label>
                        <input type="radio" id="reserved" value="reserved" v-model="state" name="state">
                    </div>
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
                search: '',
                state: null
            }
        },

        methods: {
            match: function (cat) {
                console.log(this.state)
                console.log(cat.state)
                if (this.state && this.state !== cat.state) {
                    return false;
                }

                if (this.search === '') {
                    return cat
                }

                return cat.name.toLowerCase().indexOf(this.search.toLowerCase()) >= 0;
            },

            formatedDate: (date) => {
                let now = moment()
                let current = moment(date)

                return current.from(now)
            }
        },

        computed: {
            filteredCats() {
                return this.cats.filter(cat => {
                    if (this.match(cat)) {
                        return cat
                    }
                })
            }
        }
    }
</script>
