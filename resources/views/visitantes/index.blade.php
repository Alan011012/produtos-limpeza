@extends('layouts.app')

@section('content')
    <h2 class="mt-9 text-3xl text-white font-semibold mb-6">Lista de Visitantes</h2>

    <a href="{{ route('visitantes.create') }}" class="mt-3 inline-block text-white py-2 px-4 rounded-lg bg-gray-600 hover:bg-yellow-600 transition duration-300">
        Adicionar Novo Visitante
    </a>

    <div class="overflow-x-auto mt-8">
        <table class="min-w-full bg-black text-white rounded-lg shadow-lg overflow-hidden">
            <thead class="bg-gray-600 text-white rounded-t-lg">
                <tr>
                    <th class="px-4 py-3 text-left text-sm">ID</th>
                    <th class="px-4 py-3 text-left text-sm">Nome</th>
                    <th class="px-4 py-3 text-left text-sm">Documento de Identidade</th>
                    <th class="px-4 py-3 text-left text-sm">Data de Criação</th>
                    <th class="px-4 py-3 text-left text-sm">Última Atualização</th>
                    <th class="px-4 py-3 text-left text-sm">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-gray-700">
                @foreach($visitantes as $visitante)
                    <tr class="hover:bg-gray-600 border-b border-gray-600 rounded-lg">
                        <td class="px-6 py-4 text-sm whitespace-nowrap bg-gray-800">{{ $visitante->id }}</td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap bg-gray-800">{{ $visitante->nome }}</td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap bg-gray-800">{{ $visitante->documento_identidade }}</td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap bg-gray-800">{{ $visitante->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap bg-gray-800">{{ $visitante->updated_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap bg-gray-800">
                            <div class="flex space-x-2 whitespace-nowrap">
                                <a href="{{ route('visitantes.edit', $visitante->id) }}" class="text-blue hover:text-blue-200 font-semibold transition duration-300">Editar</a>

                                <span class="text-gray-400">|</span>

                                <button onclick="openDeleteModal({{ $visitante->id }})" class="text-red-600 hover:text-red-800 font-semibold transition duration-300">Excluir</button>

                                <form id="delete-form-{{ $visitante->id }}" action="{{ route('visitantes.destroy', $visitante->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 transform transition-all duration-500 scale-75 opacity-0">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Tem certeza que deseja excluir este visitante?</h3>
            <div class="flex justify-between">
                <button onclick="closeDeleteModal()" class="px-6 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Cancelar</button>
                <button id="confirmDeleteBtn" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Excluir</button>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(visitanteId) {
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('div');

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');

            modalContent.classList.remove('scale-75', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');

            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            confirmDeleteBtn.onclick = function() {
                document.getElementById('delete-form-' + visitanteId).submit();
            }
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const modalContent = modal.querySelector('div');

            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-100', 'pointer-events-auto');

            modalContent.classList.add('scale-75', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
        }
    </script>
@endsection
