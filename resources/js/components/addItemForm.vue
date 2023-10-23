<template>
  <div class="mt-3">
    <h2>add item form</h2>
    <div class="container m-2 w-100">
      <input
        type="test"
        placeholder="add item"
        class="border"
        v-model="item.name"
      />
      <button :class="[item.name ? 'active' : 'notactive']" @click="addItem()">
        add +
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      item: {
        name: "",
      },
    };
  },
  methods: {
    addItem() {
      if (this.item.name == "") {
        return;
      }

      const headers = {
        "Content-Type": "application/json",
        Authorization: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOWVmZTVlMjM0NmNjMTliZTc0MWNjYzU5MmRkMGVjZjA3NTM3MThjMTczNGNmNzk5NTJkNmIyYjYwYzM5NDlmM2IwN2RlYWM1YmQ5NTliODEiLCJpYXQiOjE2OTgwMzQwMDIuNDMyNzAyLCJuYmYiOjE2OTgwMzQwMDIuNDMyNzA1LCJleHAiOjE3Mjk2NTY0MDIuNDI0Njk5LCJzdWIiOiI4NTA2NzAiLCJzY29wZXMiOltdfQ.FhA0JM6KSpP7nNe8nbk4H46VdF-lUGBozUe0-okQIORFqbdKwWs1DdJDNicFsyV3cQIXr2Cbpxq1BPlNpYGMn70W6mtQg1dbow2VcKoTIb7NPShx5qEJ4Vm3FlHUkoTHCGA5beo4jNzsPvvDCw4G0pbPiexcgbUgv6cNGngOi3phx4M-VFtLJC1pkxcbMFUV2JD83b28dIMKwaIEfvbKczzZhV_14lmredeHW5mCho5SAaRKQzw79suL5UEbJhPKGXFI3A9DRirX3uLPUc_FdurtKWl8Dg62emm6P4bSNcHr90D3msMXg5LAfZcmsonUkqSZaGCqFjVsm6DN6tY3xB8-WhiMKgz6J6sAheA-1JzmaBhW_1Ul5_T0wWhjlUfsRG-1c1EbbVF1qxDrq7FTbTkbaN88kYBDf6Ilme8IwU81qKn0sVLNcGPlstMEV_p4HrOA6Q4UDduNxhcPO9nMMJ23Abzd_FeTyHQm3Y6w_HRRyEB8affQNg4bXBO5q4NGIWyy3UprzCKbVJ-XYgwXhHJ6NEdS16nQj8-ep95TvCGdG9TE-JSMkekw8hf80L9hZ6TOBG0Yd3lv9fKIOgtdo6-mTJS1Thjmm9HzhkLdSLcAWP0qvQsvjCUZEPhN-odNc0hU_z7M3Foym6EDKIH7KFncicXQuYFweQhYUqIr3b4",
      };

      axios
        .post("api/task/create", {
          item: this.item,
        }, {
            headers: headers
        })
        .then((res) => {
          if (res.status == 201) {
            this.item.name = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
.active {
  color: white;
  background-color: blue;
}
.inactive {
  color: gray;
}
</style>
