<template>
  <div >
    <form class="form-inline py-2 mt-2 mt-md-0">
      <input
        name="keyname"
        v-model="keyname"
        class="form-control mr-sm-2"
        type="text"
        placeholder="Buscar"
        aria-label="Buscar"
      />

      <button class="btn btn-outline-success my-2 my-sm-0" v-on:click="find()" type="button">Buscar</button>
    </form>

    <table class="table table-sm table-hover table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">Titulo</th>
          <th scope="col">Precio</th>
          <th scope="col">Seleccinar</th>
        </tr>
      </thead>
 
      <tr v-for="(item,index) in filtrarlista" :key="index">
        <td scope="row" data-label="Titulo"> {{item.title}}  </td>
        <td data-label="Precio">{{ item.price }}</td>
        <td data-label="Seleccionar">
          <input
            type="checkbox"
            class="kits"
            :id="'kit'+item.id"
            :name="'kit'+item.id"
            :value="item.id"
            v-on:change="addKit('kit'+item.id,item.id,item.title,item.price)"
          />
        </td>
      </tr>
    </table>
  </div>
</template>
<script>
export default {
  props: ["data"],
  data() {
    return {
      keyname: "",

      items: this.data
    };
  },
  computed: {
    filtrarlista: function() {
      
      if (this.keyname) {
        return this.items.filter(item =>
          item.title.toLowerCase().includes(this.keyname.toLowerCase())
        );
      } else {
        return this.data;
      }
    }
  },
  methods: {
    find() {
      // alert(this.keyname);

      var xhr = new XMLHttpRequest();
      // Setup our listener to process completed requests

      xhr.onload = function() {
        // Process our return data
        if (xhr.status >= 200 && xhr.status < 300) {
          // What do when the request is successful
          console.log("success!", xhr.response);

          let dataProducts = JSON.parse(xhr.response);

          this.items = dataProducts;
          //     console.log("items____"+JSON.stringify(this.items));
        } else {
          // What do when the request fails
          console.log("The request failed!");

          //  console.log('success!', xhr.response);
        }

        // Code that should run regardless of the request status
        console.log("This always runs...");
      };

      xhr.open("GET", "/kit/find/" + this.keyname);
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
      xhr.send();
    },

    verDescription: function(id) {
      var xhr = new XMLHttpRequest();
      // Setup our listener to process completed requests

      xhr.onload = function() {
        // Process our return data
        if (xhr.status >= 200 && xhr.status < 300) {
          // What do when the request is successful
          console.log("success!", xhr.response);

          let dataProducts = JSON.parse(xhr.response);
          console.log(dataProducts);
          $("#exampleModal").modal("hide");

          $("#modalDescription").modal("toggle");

          let des = (document.getElementById("modalBody").innerHTML =
            dataProducts.description);
        } else {
          // What do when the request fails
          console.log("The request failed!");
          //  console.log('success!', xhr.response);
        }

        // Code that should run regardless of the request status
        console.log("This always runs...");
      };

      xhr.open("GET", "/kit/" + id);
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
      xhr.send();
    },

    addKit: function(id, producto, description, price) {
      objProductoAux = {
        id: producto,
        unitario: 0,
        total: 0,
        description: description,
        price: price,
        type: "kit",
        cantidad: 0,
        discount: 0,
        utility: 0,
        shipping: 0
      };

      var p = document.getElementById(id);
      if (p.checked) {
        arrayKitsSelecionados.push(objProductoAux);
        arrayConceptosSelecionados.push(objProductoAux);
      } else {
        removeElementJ(arrayKitsSelecionados, objProductoAux);
        removeElementJ(arrayConceptosSelecionados, objProductoAux);
      }
      calcularTotales();
    }

    // alert(productos);
  },

  created() {},
  mounted() {
    console.log("ok Maguey" + this.data[0].title);
  }
};
</script>