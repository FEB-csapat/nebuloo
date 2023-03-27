<template>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Questions</h1>
        <div class="row bg-light rounded-4 mb-3 shadow">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae urna ut arcu mattis pulvinar a ut enim. Integer eget libero accumsan, porta nisi in, consequat quam. Aenean porttitor laoreet nibh, vitae tempor tortor viverra quis. Proin quis ipsum quis justo efficitur fermentum ac quis lorem. Integer pulvinar lectus ut sapien viverra, id cursus lectus iaculis. Aliquam vel vestibulum est, vitae tempor mauris. Sed a condimentum dolor. Aliquam in neque ac orci auctor laoreet. Cras blandit est a quam congue, vitae eleifend tellus fermentum. Fusce eu turpis sodales, lacinia ligula sed, scelerisque orci. Quisque pellentesque rhoncus risus et cursus. Phasellus vulputate ac est in mattis. Maecenas eros sapien, finibus id suscipit id, fermentum a tellus. Phasellus mattis nunc id egestas iaculis. Sed eu eros tincidunt, placerat ligula ac, bibendum sem.</p>
            <div class="m-2">
                <button class="btn m-1 pt-0" id="tag">Tag1</button>
                <button class="btn m-1 pt-0" id="tag">Tag2</button>
            </div>
        </div>
        <div class="row bg-light rounded-4 mb-3 shadow">
            <p>Quisque iaculis ex risus, et pellentesque risus facilisis id. Integer urna quam, condimentum quis purus quis, accumsan vulputate urna. Fusce feugiat nisi eu molestie posuere. Ut eget interdum dui. Proin dapibus ex sit amet diam placerat semper. Nullam quis volutpat ante. Integer ut urna risus.</p>
            <div class="m-2">
                <button class="btn m-1 pt-0" id="tag">Tag1</button>
                <button class="btn m-1 pt-0" id="tag">Tag2</button>
            </div>
        </div>
    </div>
    <router-link class="nav-link active" aria-current="page" to="/create/question">
        <div class="fab-button" @click="onClick">
            <span class="m-3">Create new question</span>
            <i class="fas fa-plus fa-lg"/>
        </div>
    </router-link>
</template>

<script>

</script>