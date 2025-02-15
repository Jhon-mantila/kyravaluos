<template>
    <AuthenticatedLayout>
    <template #header>  
        <h2
            class="text-xl font-semibold leading-tight text-gray-800"
        >
            Visitadores
        </h2>
    </template>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <div>
                            <!-- Barra de búsqueda -->
                            <input
                                type="text"
                                v-model="search"
                                placeholder="Buscar visitadores..."
                                @input="onSearch"
                            />
                            <!-- Tabla de visitadores -->
                            <table>
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Ciudad</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="visitador in visitadores.data" :key="visitador.id">
                                    <td>{{ visitador.user.name }}</td> <!-- Nombre del usuario -->
                                    <td>{{ visitador.user.email }}</td> <!-- Email del usuario -->
                                    <td>{{ visitador.ciudad }}</td> <!-- Ciudad del visitador -->
                                    <td>{{ visitador.active ? 'Sí' : 'No' }}</td> <!-- Estado activo -->
                                    <td>
                                    <a :href="`/visitadores/${visitador.id}/edit`">Editar</a>
                                    <button @click="deleteVisitador(visitador.id)">Eliminar</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        
                            <!-- Paginación -->
                            <div>
                                <pagination :links="visitadores.links" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </AuthenticatedLayout>
</template>
  
<script setup>
  import { ref, watch } from 'vue';
  import { router } from '@inertiajs/vue3'; // Usa `router` en lugar de `Inertia`
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import Pagination from '@/Components/Pagination.vue';
  
  const props = defineProps({
      visitadores: Object,
      filters: Object,
  });
  
  const search = ref(props.filters.search || '');
  
  const onSearch = () => {
      router.get('/visitadores', { search: search.value }, {
          preserveState: true,
          replace: true,
      });
  };
  
  watch(search, (value) => {
      onSearch();
  });
</script>
  
  <style scoped>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  th {
    background-color: #f2f2f2;
  }
  </style>