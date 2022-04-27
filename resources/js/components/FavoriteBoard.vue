<template>
    <div class="favorite">
        <i class="fa-regular fa-heart" :class="onClickFavorite"></i>
    </div>
</template>

<script>

export default {
    name: "FavoriteSomething",
    props: {
        favorite_num: Number,
        board_id: Number,
    },
    data: function() {
        return {
            favorite_num: this.favorite_num,
            isActive: false,
        }
    },
    computed: {
        calcFavoriteNum () {
            //いいね数の更新処理
        }
    },
    mounted: {
        onClickFavorite (){
            //クリックイベント
        }
    },
    methods : {
        putFavoriteData() {
            axios.put(

            ).then(
                //お気に入り数のローカルプロパティ更新
            ).catch(
                
            )
        },
        deleteFavoriteData() {
            axios.delete(

            ).then(
                //お気に入り数のローカルプロパティ更新
            ).catch(

            )
        }

    }
}

</script>