<template>
    <div class="container">
        <div class="row bg-light mt-3 rounded-3 p-3 shadow">
            <div class="col text-center">
                <img src="https://placeholder.pics/svg/60" alt="">
            <p class="fs-6">Rangom</p>
            <p class="fs-4">Nevem</p>
            </div>
            <form action="">
                <h2>Bio:</h2>
                <input type="text" class="form-control my-3" name="bio" id="bio">
                <h2>Érdekeltségi kör:</h2>
                <select id="interest" class="form-select my-3">
                    <option data-hidden="true">Válasszon!</option>
                    <option>Fizika</option>
                    <option>Kémia</option>
                    <option>Matematika</option>
                </select>
                <div class="text-end">
                    <button type="submit" value="send" class="btn" id="button"><router-link class="nav-link active" aria-current="page" to="/myprofile">Kész</router-link></button>
                </div>
            </form>
      <ul class="ps-5">
        <li>Matematika</li>
        <li>Testnevelés</li>
      </ul>
        </div>
    </div>
    </template>
    <script>
    
    </script>