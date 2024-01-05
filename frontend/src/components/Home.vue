<template>
  <v-layout class="rounded rounded-md">
    <v-app-bar color="surface-variant" title="Application bar"></v-app-bar>
    <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
      <v-container>
        <v-sheet>
        <v-row align="center" justify="center">
          <v-switch v-model="switchValue" :label="render === true ? 'No Archivadas' : 'Archivadas'"></v-switch>
          <v-col v-for="note in notes" :key="note.id" cols="auto">
            <Notes :title="note.title" :content="note.content"></Notes>
            <div style="display: flex; align-items: center;">
            <edit-notes-modal :noteData="note"></edit-notes-modal>
            <v-btn @click="deleteNote(note.id)" class="bg-red">DELETE</v-btn>
              <div v-if="note.archived === 0">
                <v-btn @click="archiveNote(note.id)">ARCHIVE NOTE</v-btn>
              </div>
              <div v-if="note.archived === 1">
              <v-btn @click="unArchiveNote(note.id)">UNARCHIVE NOTE</v-btn>
              </div>
            </div>
          </v-col>
        </v-row>
        </v-sheet>
      </v-container>
      <create-notes-modal></create-notes-modal>
    </v-main>
  </v-layout>
</template>
<script>
import Notes from "@/components/Notes.vue";
import axios from "axios";
import CreateNotesModal from "@/components/createNotesModal.vue";
import EditNotesModal from "@/components/editNotesModal.vue";
export default {
  components: {EditNotesModal, CreateNotesModal, Notes},
  data() {
    return {
      notes : [],
      variants: ['flat'],
      render: true
    };
  },
  computed: {
    switchValue: {
      get() {
        return this.render === false;
      },
      set(value) {
        this.render = !value;
        this.fetchNotesData();
      }
    }
  },
  mounted() {
    this.fetchNotesData();
  },
  methods: {
    async fetchNotesData() {
      try {
        let endpoint = "notes";
        if (this.render === false) {
          endpoint = "notes/unactive-notes";
        } else if (this.render === true) {
          endpoint = "notes/active-notes";
        }
        console.log(endpoint)
        const response = await axios.get(endpoint);
        this.notes = response.data.info;
        console.log(this.notes)
      } catch (error) {
        console.log(error);
      }
    },
    async handleSwitchChange(value) {
      this.render = !this.render;
      console.log(this.render);
      this.fetchNotesData();
    },
    async deleteNote(note){
      try {
        const deleteNote = axios.delete(`notes/${note}`)
        console.log(note)
        await this.fetchNotesData();
      }catch (e){
        console.log(e);
      }
    },
    async archiveNote(note){
      try {
        const archiveNote = axios.post(`notes/${note}/archive`)
        console.log(note)
        await this.fetchNotesData();
      }catch (e){
        console.log(e);
      }
    },
    async unArchiveNote(note){
      try {
        const unArchiveNote = axios.post(`notes/${note}/unarchive`)
        console.log(note)
        await this.fetchNotesData();
      }catch (e){
        console.log(e);
      }
    },
  }
}


</script>
