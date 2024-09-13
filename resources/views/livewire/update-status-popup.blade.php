<div>
    <!-- Button to trigger modal -->
    <button wire:click="$set('open', true)"
        class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
        Mise à jour du statut
    </button>

    <!-- Modal -->
    @if ($open)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="w-full max-w-lg p-6 bg-white rounded-lg">
                <h2 class="mb-4 text-xl font-semibold">Mise à jour du statut</h2>
                <form wire:submit.prevent="updateStatus">
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Nouveau statut</label>
                        <select wire:model="status" id="status"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Sélectionnez un statut</option>
                            <option value="approuvée">Approuvée</option>
                            <option value="rejetée">Rejetée</option>
                            <option value="en attente">En attente</option>
                        </select>
                        @error('status')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="commentaire" class="block text-sm font-medium text-gray-700">Commentaire</label>
                        <textarea wire:model="commentaire" id="commentaire"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                        @error('commentaire')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
                            Mettre à jour
                        </button>
                        <button type="button" wire:click="$set('open', false)"
                            class="px-4 py-2 ml-2 font-semibold text-gray-700 bg-gray-300 rounded hover:bg-gray-400">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
