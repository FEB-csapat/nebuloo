<template>
    <div class="d-flex bg-light shadow rounded-3 p-2 mt-2">
        <div>
            <img style="width:70px; height:50px" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimg.favpng.com%2F25%2F7%2F23%2Fcomputer-icons-user-profile-avatar-image-png-favpng-LFqDyLRhe3PBXM0sx2LufsGFU.jpg&f=1&nofb=1&ipt=c5a94872939138fcc06ee18319a0597d58d783928d3c834f2bd4dcad8c94662a&ipo=images" alt="avatar">
            <div class="col">
                <h6>Gönczi Dénes</h6>
                <p>2022.01.01</p>
            </div>
        </div>
        <div class="flex-fill">
            <p>{{comment.body}}</p>
        </div>
    </div>
</template>

<script>
export default{
    props:{
        comment: Object,
    },
    mounted(){
    }
}
</script>