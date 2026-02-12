<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionRelationship;
use App\Models\Usertype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $usertypeID = $request->get('usertypeID', 1); // Default to Admin
        $usertypes = Usertype::all();

        // Get all currently assigned permission IDs for this user type
        $assignedPermissionIDs = PermissionRelationship::where('usertypeID', $usertypeID)
            ->pluck('permissionID')
            ->toArray();

        $modules = $this->getModuleDefinitions();

        return view('permission.index', compact('usertypes', 'usertypeID', 'modules', 'assignedPermissionIDs'));
    }

    public function store(Request $request)
    {
        $usertypeID = $request->usertypeID;
        $permissions = $request->permissions ?? []; // Array of permission names from checkboxes

        DB::beginTransaction();
        try {
            // Remove existing relationships for this usertype
            PermissionRelationship::where('usertypeID', $usertypeID)->delete();

            foreach ($permissions as $permissionName) {
                // Find or create the permission by name
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                
                // Create relationship
                PermissionRelationship::create([
                    'usertypeID' => $usertypeID,
                    'permissionID' => $permission->permissionID
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Permisos actualizados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar los permisos: ' . $e->getMessage());
        }
    }

    private function getModuleDefinitions()
    {
        return [
            ['name' => 'Dashboard', 'actions' => ['view']],
            ['name' => 'Estudiante', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Padres', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Docente', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Usuario', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Clases', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Tema', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Seccion', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Plan de estudios', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Asignación', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Horario', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Asistencia de estudiante', 'actions' => ['add', 'view']],
            ['name' => 'Asistencia docente', 'actions' => ['add', 'view']],
            ['name' => 'Examen', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Horario de examen', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Grado', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Biblioteca', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Transporte', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Hospedaje', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Cuenta', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Anuncio', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Reporte', 'actions' => ['view']],
            ['name' => 'Configuración', 'actions' => ['edit', 'view']],
        ];
    }
}
