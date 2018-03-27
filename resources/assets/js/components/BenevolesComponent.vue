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
                        <label for="fa">FA</label>
                        <input type="checkbox" id="fa" v-model="fa" name="fa">
                    </div>

                    <div class="form-group" style="margin: 20px;">
                        <label for="member">Membre</label>
                        <input type="checkbox" id="member" v-model="member" name="member">
                    </div>

                    <div class="form-group" style="margin: 20px;">
                        <label for="feeding">Nourrisseur</label>
                        <input type="checkbox" id="feeding" v-model="feed" name="feeding">
                    </div>

                    <div class="form-group" style="margin: 20px;">
                        <label for="capture">Capture</label>
                        <input type="checkbox" id="capture" v-model="capture" name="capture">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div v-for="benevole in filteredBenevoles">
                <a style="text-decoration: none; color: grey" :href="'/benevoles/' + benevole.id">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h1>{{ benevole.name }}</h1>
                                <h5>{{ benevole.email }}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['benevoles'],

        data() {
            return {
                search : '',
                feed : false,
                member : false,
                fa : false,
                capture : false
            }
        },

        methods : {
            match : function (benevole) {

                if (this.fa && benevole.fa == false) {
                    return false
                }

                if (this.member && benevole.member == false) {
                    return false
                }

                if (this.feed && benevole.feeding == false){
                    return false
                }

                if (this.capture && benevole.capture == false){
                    return false
                }

                if (this.search === '')
                    return benevole

                return benevole.name.toLowerCase().indexOf(this.search.toLowerCase()) >= 0;
            }
        },

        computed: {
            filteredBenevoles() {
                return this.benevoles.filter(benevole => {
                    if (this.match(benevole)) {
                        return benevole
                    }
                })
            }
        }
    }
</script>
