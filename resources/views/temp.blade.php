
Route::get('/items/groups', ['uses' => 'Procurement\ItemGroupsController@index'])->name('items.index');
Route::get('/items/groups/create/{type?}/{id?}', ['uses' => 'Procurement\ItemGroupsController@create'])->name('item.groups.create');
Route::post('/item/groups/store', ['uses' => 'Procurement\ItemGroupsController@store'])->name('item.groups.store');
Route::get('/item/groups/{id}/edit', ['uses' => 'Procurement\ItemGroupsController@edit'])->name('item.groups.edit');
Route::post('/item/groups/update', ['uses' => 'Procurement\ItemGroupsController@update'])->name('item.groups.update');
Route::delete('/item/groups/delete/{id}', ['uses' => 'Procurement\BrandsController@delete'])->name('item.groups.delete');
