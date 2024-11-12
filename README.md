1.hasOne=>one to one (only one data in parent and child ,no duplicate data )(return single instances)
2.hasMany,BelongsTo =>one to many(return collection so you need to use foreach or pluck while getting attribute)
  <td>{{ $user->address->pluck('country_name')->join(', ') }}</td>
*hasMany(,Use in parent model,when parent point to childs )
*BelongsTo(Use in child model,when childs point to parent)
