<template>
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h2 class="border-bottom border-gray pb-2 mb-0">Editar Perfil</h2>
        <div class="col-md-12 pt-3">
            <form
                class="needs-validation"
                @submit="checkForm"
                ref="myForm"
                novalidate
            >
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom01">Nombre Completo</label>
                        <input
                            type="text"
                            v-model="user.name"
                            class="form-control"
                            name="name"
                            value="Nombre"
                            required
                        />
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="validationCustomUsername">Correo</label>
                        <div class="input-group">
                            <input
                                v-model="user.email"
                                type="email"
                                class="form-control"
                                name="email"
                                aria-describedby="inputGroupPrepend"
                                required
                            />
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <img
                            v-bind:src="image_src"
                            width="35%"
                            id="firma"
                            alt="Foto de perfil no disponible"
                        />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label for="validationCustom03"
                            >Tu ID en el sistema</label
                        >
                        <input
                            type="text"
                            readonly
                            v-model="user.prefix"
                            class="form-control"
                            id="validationCustom03"
                            required
                        />
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationCustom03"
                            >Abrev. de profesión</label
                        >
                        <input
                            type="text"
                            name="grado"
                            v-model="user.grado"
                            class="form-control"
                            id="validationCustom03"
                            required
                        />
                        <div class="invalid-feedback">
                           
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="validationCustom03">Tu área</label>
                        <input
                            type="text"
                            name="cargo"
                            v-model="user.cargo"
                            class="form-control"
                            id="validationCustom03"
                            required
                        />
                        <div class="invalid-feedback">
                            
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text"
                                    id="inputGroupFileAddon01"
                                    >Subir foto</span
                                >
                            </div>
                            <div class="custom-file">
                                <input
                                    name="profile_pic"
                                    id="profile_pic"
                                    ref="file"
                                    type="file"
                                    v-on:change="setFileName"
                                    class="custom-file-input"
                                    aria-describedby="inputGroupFileAddon01"
                                />
                                <label
                                    class="custom-file-label"
                                    for="inputGroupFile01"
                                    >{{ labelFile }}</label
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group"></div>
                <button class="btn btn-primary" type="submit">
                    Guardar datos
                </button>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    props: ["data"],
    data() {
        return {
            user: {},
            labelFile: "Firma digital",
            image_src: "../perfil.png",
        };
    },
    methods: {
        checkForm: function (e) {
            var myFormData = new FormData(this.$refs.myForm);
            axios({
                method: "post",
                url: "/user/profile/photo",
                data: myFormData,
                config: { headers: { "Content-Type": "multipart/form-data" } },
            }).then((response) => {
                alert(response.data.message);

                this.user = response.data.user_n;
                console.log(this.user);
                document.getElementById("firma").src = this.user.url_firm;
            });
            e.preventDefault();
        },
        setFileName: function (e) {
            //get the file name
            try {
                var fileName = e.target.files[0].name;
                console.log(fileName);
                this.labelFile = fileName;
            } catch (error) {
                console.log(error);
            }

            //replace the "Choose a file" label
            // $(this).next('.custom-file-label').html(fileName);
        },
    },
    mounted() {},
    created() {
        axios.get("/user").then((res) => {
            this.user = res.data.data;

            console.log(res.data.data);
            console.log("ok");
            if (this.user.url_firm != null) {
                this.image_src = this.user.url_firm;
            }
        });
    },
};
</script>
