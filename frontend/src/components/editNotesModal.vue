<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      width="1024"
    >
      <template v-slot:activator="{ props }">
        <v-btn
          color="primary"
          v-bind="props"
        >
          Edit Note
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">Edit a Note</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row class="d-flex justify-content-around">
              <v-col cols="12">
                <v-select type="select" v-model="noteData.categories_id" :items="this.categories" item-value="id" item-title="name" label="Category" placeholder="Choose a category" required>
                </v-select>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Title"
                  v-model="noteData.title"
                  required
                ></v-text-field>
              </v-col>
              <v-col>
                <v-text-field
                  label="Content"
                  v-model="noteData.content"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue-darken-1"
            variant="text"
            @click="dialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="blue-darken-1"
            variant="text"
            @click="dialog = false; editNote(noteData.id);"
          >
            Upload
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import axios from "axios";

export default {
  props:{
    noteData: {
      type: Object,
      required: true,
    }
  },
  data: () => ({
    dialog: false,

    categories: [],
    categoriesNames: [],
    notes: {
      title: "",
      content: "",
      categories_id: "",
    },
    errors: {},
  }),
  mounted(){
    this.fetchAllCategories();
  },
  computed(){
  },
  methods: {
    async fetchAllCategories(){
      try {
        const response = await axios.get("categories")
        this.categories = response.data;
        console.log(this.categories)
      }
      catch (error) {
        if (error.response && error.response.data) {
          console.log(error.response);
        }
      }
    },
    async editNote(id) {
      try {
        console.log(this.noteData)
        const response = await axios.put(`notes/${id}`, this.noteData)
        console.log(response)
      } catch (error) {
        if (error.response && error.response.data) {
          console.log(error.response);
        }
      }
    },
  }
}
</script>
