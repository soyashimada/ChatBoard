<template>


</template>

<script>

export default {
    name: "FavoriteSomething",
    props: {
        something: Number,
    },
    data: function() {
        return {

        }
    },
    methods : {
        getSomethingData() {
            if(this.something == 0){
                //Board
                axios.get("")

            }else if(this.something == 1){
                //Post
            }
        },


    }
}

</script>