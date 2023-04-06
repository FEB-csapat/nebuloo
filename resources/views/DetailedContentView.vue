<template>
    <div class="container my-3 ">
        <h1 id="title">Tananyag megtekintése</h1>
        <div class="row bg-light shadow rounded-3 p-2">
            <div class="row">
                <img style="width:100px; height:70px" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimg.favpng.com%2F25%2F7%2F23%2Fcomputer-icons-user-profile-avatar-image-png-favpng-LFqDyLRhe3PBXM0sx2LufsGFU.jpg&f=1&nofb=1&ipt=c5a94872939138fcc06ee18319a0597d58d783928d3c834f2bd4dcad8c94662a&ipo=images" alt="avatar">
                <div class="col">
                    <h4>Gönczi Dénes</h4>
                    <p>2022.01.01</p>
                </div>
            </div>

            
            <textarea ref="editor" name="leiras" id="leiras" class="form-control">
# Onus illa victore ocior
## De quodque et 
Lorem markdownum easdem a [Procnen](http://www.moriorque.io/precesque) namque
abruptaque [alto](http://www.patettandem.org/tenebris-thymo.html): erat huius
disparibus properabat demens cupido orbae, est primo quicquam. Priamusque omnis
mea litora auras tangentiaque siste; Siphnon sed Phlegon vocet Phrygia cvrrvs
dubitor. Hoc corpora! Induta furiosaque et Stygia temptanti ulli multaque,
feroces condicione spicea inattenuata intravit coniuge auget me Pelasgos raptam
possit. Regina et fugias lubrica poterat.

![cica](https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.pepita.hu%2Fimages%2Fproduct%2F340212%2Fpamut-torolkozo-cica-feher_30833634_1200x630.jpg&f=1&nofb=1&ipt=43d51356b1d145d31e7a464085e3b61ea34b586ffdd4a50eae23a3b0a58dd15d&ipo=images)

## Nec infelix est

Liceat iussisque quaeritur factum, aurum emicat arma aquarum esse: comas hic
nubibus si Achivos. Et dubiae placet. Nigrantis petuntur de diluvio novis
cuncta, fuit!

- Utentem domos in
- Dumque erit ubi agitatis natam
- Canum Xanthos patetis et sacroque alipedum in
- Frustra dies sit rarus
- Vera invecta triumphis coeunt

## Lactantia tui Phoce profatur victima

**Movit** dolos vultus? Illam *dedit* missae di soporem inque poscebat? Rursus
sena memoro manibus sedebat: contineat *reor crura*; Ismario ad quaerit currum
consequar aequora, sed fratri.

- Latratibus rapit labore mihi adhuc culpae arborea
- Cillan es habebat tu quod postquam
- Gaudet pretiosior suoque alas lympha cannae murum
- Inmeritae desinere caeleste ignibus oscula carentia armigerae
- Euntis nisi numeroque lumine area inobservatus reverentia

Levis circa? His de saevis, aliter perspicit scylla gerunt. Latos tunc simplex
coepere inplebat victus nocte et ante mors Aquilone phaethon, Pergama festa
undas Lucifero tumebat, cognita. Perque inertes vana, habe undis haec denique
dantem me conamina, ad.
            </textarea>

            <button class="btn" id="button">
                Letöltés
            </button>
        </div>


        <h2>Kommentek:</h2>

        <div class="col">
            <CommentCard v-for="comment in comments" :key="comment.id" :comment="comment" />
        </div>
        
    </div>
    
</template>

<script>
import EasyMDE from 'easymde';
import CommentCard  from '../components/CommentCard.vue';

export default{
    props:{
        content: {
            type: Object,
            required: true
        }
        
    },
    components:{
        CommentCard
    },
    data() {
        return {
        comments: [
            { id: 1, body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
            { id: 2, body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
            { id: 3, body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
        ],
        };
    },
    mounted(){
        
        this.editor = new EasyMDE({
            element: this.$refs.editor,
            readOnly: true,
            toolbar: false,
            spellChecker: false,
        });

        this.editor.togglePreview();
    },
};
</script>

<style>
.easymde-container.CodeMirror {
    border: none;
    background-color: green;
    overflow: hidden;
}
.easymde-preview img {
    max-width: 100%;
    height: auto;
}
</style>
