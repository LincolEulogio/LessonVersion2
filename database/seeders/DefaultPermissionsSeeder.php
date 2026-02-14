<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\PermissionRelationship;
use App\Models\Usertype;
use Illuminate\Support\Str;

class DefaultPermissionsSeeder extends Seeder
{
    public function run()
    {
        $roleMapping = [
            'Administrador' => 'Admin',
            'Docente' => 'Teacher',
            'Estudiante' => 'Student',
            'Padres' => 'Parent',
            'Secretaria' => 'Receptionist',
            'Bibliotecario' => 'Librarian'
        ];

        $modules = [
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
            ['name' => 'Asistencia examen', 'actions' => ['add', 'view']],
            ['name' => 'Promedio', 'actions' => ['add', 'view']],
            ['name' => 'Porcentaje promedio', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Promoción', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Conversación', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Multimedia', 'actions' => ['add', 'delete', 'view']],
            ['name' => 'Correo', 'actions' => ['add', 'view']],
            ['name' => 'Miembro de la biblioteca', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Libros', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Libro de publicación', 'actions' => ['add', 'edit', 'view']],
            ['name' => 'Transporte', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Miembro transporte', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Hospedaje', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Categoria hospedaje', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Miembro hospedaje', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Tipo de tarifa', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Factura', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Historial de pago', 'actions' => ['edit', 'delete', 'view']],
            ['name' => 'Gasto', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Noticias', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Evento', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Vacaciones', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Reportes', 'actions' => ['view']],
            ['name' => 'informcion del visitante', 'actions' => ['delete', 'view']],
            ['name' => 'Año académico', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Administrador del sistema', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Reiniciar contraseña', 'actions' => ['view']],
            ['name' => 'Plantilla mail', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Importar', 'actions' => ['add', 'view']],
            ['name' => 'Backup', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'usuarios/rol', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Permiso', 'actions' => ['add', 'edit', 'delete', 'view']],
            ['name' => 'Actualizacion', 'actions' => ['edit', 'view']],
            ['name' => 'Configuración general', 'actions' => ['edit', 'view']],
            ['name' => 'Configuración de pago', 'actions' => ['edit', 'view']],
            ['name' => 'Configuración sms', 'actions' => ['edit', 'view']],
        ];

        // Ensure all permutations exist
        foreach ($modules as $m) {
            $slug = Str::slug($m['name'], '_');
            foreach ($m['actions'] as $a) {
                Permission::firstOrCreate(['name' => $slug . '_' . $a]);
            }
        }

        $roles = [
            'Administrador' => 'all',
            'Docente' => [
                'dashboard_view', 
                'estudiante_view',
                'docente_view',
                'clases_view',
                'tema_add', 'tema_edit', 'tema_delete', 'tema_view',
                'seccion_view',
                'plan_de_estudios_add', 'plan_de_estudios_edit', 'plan_de_estudios_delete', 'plan_de_estudios_view',
                'asignacion_add', 'asignacion_edit', 'asignacion_delete', 'asignacion_view',
                'horario_view',
                'asistencia_de_estudiante_add', 'asistencia_de_estudiante_edit', 'asistencia_de_estudiante_view',
                'asistencia_docente_view',
                'examen_add', 'examen_edit', 'examen_delete', 'examen_view',
                'horario_de_examen_view',
                'grado_add', 'grado_edit', 'grado_delete', 'grado_view',
                'asistencia_examen_add', 'asistencia_examen_view',
                'promedio_add', 'promedio_view',
                'conversacion_add', 'conversacion_view', 'conversacion_edit',
                'multimedia_add', 'multimedia_delete', 'multimedia_view',
                'noticias_view', 'evento_view', 'vacaciones_view',
                'reportes_view'
            ],
            'Estudiante' => [
                'dashboard_view', 
                'docente_view', 
                'clases_view',
                'tema_view',
                'seccion_view',
                'plan_de_estudios_view',
                'asignacion_add', 'asignacion_view',
                'horario_view',
                'horario_de_examen_view',
                'promedio_view',
                'conversacion_add', 'conversacion_view',
                'multimedia_view',
                'libros_view', 'libro_de_publicacion_view',
                'factura_view', 
                'noticias_view', 'evento_view', 'vacaciones_view'
            ],
            'Padres' => [
                'dashboard_view', 
                'docente_view', 
                'clases_view',
                'horario_view',
                'asistencia_de_estudiante_view',
                'promedio_view', 
                'conversacion_add', 'conversacion_view',
                'miembro_de_la_biblioteca_view', 'libro_de_publicacion_view',
                'miembro_transporte_view', 
                'miembro_hospedaje_view',
                'factura_view', 
                'noticias_view', 'evento_view', 'vacaciones_view'
            ],
            'Secretaria' => [
                'dashboard_view', 
                'estudiante_add', 'estudiante_edit', 'estudiante_delete', 'estudiante_view',
                'padres_add', 'padres_edit', 'padres_delete', 'padres_view',
                'docente_edit', 'docente_view', // Can view and edit teachers but not add/delete typically
                'usuario_view',
                'clases_add', 'clases_edit', 'clases_delete', 'clases_view',
                'tema_view',
                'seccion_add', 'seccion_edit', 'seccion_delete', 'seccion_view',
                'horario_add', 'horario_edit', 'horario_delete', 'horario_view',
                'asistencia_docente_add', 'asistencia_docente_edit', 'asistencia_docente_view',
                'asistencia_de_estudiante_view', 'asistencia_de_estudiante_edit', 
                'miembro_transporte_add', 'miembro_transporte_edit', 'miembro_transporte_delete', 'miembro_transporte_view',
                'miembro_hospedaje_add', 'miembro_hospedaje_edit', 'miembro_hospedaje_delete', 'miembro_hospedaje_view',
                'tipo_de_tarifa_add', 'tipo_de_tarifa_edit', 'tipo_de_tarifa_delete', 'tipo_de_tarifa_view',
                'factura_add', 'factura_edit', 'factura_delete', 'factura_view',
                'historial_de_pago_edit', 'historial_de_pago_delete', 'historial_de_pago_view',
                'gasto_add', 'gasto_edit', 'gasto_delete', 'gasto_view',
                'noticias_add', 'noticias_edit', 'noticias_delete', 'noticias_view',
                'evento_add', 'evento_edit', 'evento_delete', 'evento_view',
                'vacaciones_add', 'vacaciones_edit', 'vacaciones_delete', 'vacaciones_view',
                'correo_add', 'correo_view'
            ],
            'Bibliotecario' => [
                'dashboard_view', 
                'docente_view',
                'estudiante_view',
                'miembro_de_la_biblioteca_add', 'miembro_de_la_biblioteca_edit', 'miembro_de_la_biblioteca_delete', 'miembro_de_la_biblioteca_view',
                'libros_add', 'libros_edit', 'libros_delete', 'libros_view',
                'libro_de_publicacion_add', 'libro_de_publicacion_edit', 'libro_de_publicacion_view',
                'noticias_view', 'evento_view', 'vacaciones_view'
            ],
            'Accountant' => [
                'dashboard_view',
                'tipo_de_tarifa_view', 'tipo_de_tarifa_edit',
                'factura_view', 'factura_edit',
                'historial_de_pago_view', 'historial_de_pago_edit',
                'gasto_view', 'gasto_edit',
                'reportes_view'
            ]
        ];

        foreach ($roles as $roleName => $perms) {
            // Mapping check: find if the English version exists
            $englishName = $roleMapping[$roleName] ?? null;
            
            $userType = null;
            
            if ($englishName) {
                $userType = Usertype::where('usertype', $englishName)->first();
            }
            
            if (!$userType) {
                $userType = Usertype::where('usertype', $roleName)->first();
            }

            if (!$userType) {
                $userType = Usertype::create([
                    'usertype' => $roleName,
                    'create_date' => now(),
                    'modify_date' => now(),
                    'create_userID' => 1,
                    'create_username' => 'system',
                    'create_usertype' => 'Admin'
                ]);
            } else {
                // If it was the English name, rename it to Spanish
                if ($userType->usertype !== $roleName) {
                    // Check if the Spanish name already exists as a separate record
                    $duplicate = Usertype::where('usertype', $roleName)
                        ->where('usertypeID', '!=', $userType->usertypeID)
                        ->first();
                    
                    if ($duplicate) {
                        // Move users from duplicate to this one (optional but recommended)
                        \Illuminate\Support\Facades\DB::table('students')->where('usertypeID', $duplicate->usertypeID)->update(['usertypeID' => $userType->usertypeID]);
                        \Illuminate\Support\Facades\DB::table('teachers')->where('usertypeID', $duplicate->usertypeID)->update(['usertypeID' => $userType->usertypeID]);
                        \Illuminate\Support\Facades\DB::table('parents')->where('usertypeID', $duplicate->usertypeID)->update(['usertypeID' => $userType->usertypeID]);
                        \Illuminate\Support\Facades\DB::table('systemadmins')->where('usertypeID', $duplicate->usertypeID)->update(['usertypeID' => $userType->usertypeID]);
                        \Illuminate\Support\Facades\DB::table('users')->where('usertypeID', $duplicate->usertypeID)->update(['usertypeID' => $userType->usertypeID]);
                        
                        $duplicate->delete();
                    }
                    
                    $userType->update(['usertype' => $roleName]);
                }
            }

            PermissionRelationship::where('usertypeID', $userType->usertypeID)->delete();

            if ($perms === 'all') {
                $allPerms = Permission::all();
                foreach ($allPerms as $p) {
                    PermissionRelationship::create([
                        'usertypeID' => $userType->usertypeID,
                        'permissionID' => $p->permissionID
                    ]);
                }
            } else {
                foreach ($perms as $pName) {
                    $p = Permission::where('name', $pName)->first();
                    if ($p) {
                        PermissionRelationship::create([
                            'usertypeID' => $userType->usertypeID,
                            'permissionID' => $p->permissionID
                        ]);
                    }
                }
            }
        }
    }
}
