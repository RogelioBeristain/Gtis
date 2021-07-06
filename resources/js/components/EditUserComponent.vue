<template>
    <div class="edit-user float-right col-md-8">
        <form class="">
            <h2>Editar datos</h2>
            <div class="form-group">
                <label for="staticEmail2">Correo</label>
                <input
                    type="email"
                    v-bind:value="change.email"
                    class="form-control"
                />
            </div>

            <div class="form-group">
                <label for="inputPassword2">Tipo de usuario</label>
                <input
                    type="text"
                    v-bind:value="change.role"
                    class="form-control"
                    id="inputPassword2"
                    placeholder="Rol"
                />
            </div>
            <div class="form-group">
                <label for="inputPassword2">Cambiar contraseña</label>
                <input
                    type="password"
                    class="form-control"
                    id="inputPassword2"
                    placeholder="Nueva contraseña"
                />
            </div>
            <button type="submit" class="btn btn-primary">Guardar datos</button>
        </form>
    </div>
</template>
<script>
export default {
    props: ["data"],
    data: function () {
        return {
            user: this.data.data,
        };
    },
    mounted: function () {},
    computed: {
        change: function () {
            return (this.user = this.data);
        },
    },
};
</script>
