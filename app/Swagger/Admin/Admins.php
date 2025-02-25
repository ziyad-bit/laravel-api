<?php

namespace App\Swagger\Admin;

/**
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="JWT",
 *   description="Enter JWT token in the format **Bearer <token>**"
 * )
 */
class Admins
{
    /**
     * @OA\Post(
     *     path="/api/admins/add",
     *     summary="Create a new admin",
     *     description="Creates a new admin record using the provided validated data.",
     *     operationId="createAdmin",
     *     tags={"Admins"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Admin data to create a new admin",
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="John Doe"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 example="john.doe@example.com"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 example="secret123"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="admin",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=2),
     *                 @OA\Property(property="name", type="string", example="Jo Doe"),
     *                 @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-02-25T18:27:16.000000Z")
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="you successfully created it"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content - Validation errors",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="The given data was invalid."
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     type="array",
     *                     @OA\Items(
     *                         type="string",
     *                         example="The email field is required."
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="array",
     *                     @OA\Items(
     *                         type="string",
     *                         example="The name field is required."
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="something went wrong")
     *         )
     *     )
     * )
     */
    public function add()
    {
    }

    /**
     * @OA\Put(
     *     path="/api/admins/update/{admin}",
     *     summary="Update an admin",
     *     description="Updates an admin record using the provided validated data.",
     *     operationId="updateAdmin",
     *     tags={"Admins"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="admin",
     *         in="path",
     *         description="ID of the admin to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_method",
     *         in="query",
     *         description="Request method override, should be 'put'",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="put"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Admin data to update",
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="John Doe"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 example="john.doe@example.com"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 format="password",
     *                 example="secret123"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="admin",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=2),
     *                 @OA\Property(property="name", type="string", example="Jo Doe"),
     *                 @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-02-25T18:27:16.000000Z")
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="you successfully updated it"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content - Validation errors",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="The given data was invalid."
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     type="array",
     *                     @OA\Items(
     *                         type="string",
     *                         example="The email field is required."
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="array",
     *                     @OA\Items(
     *                         type="string",
     *                         example="The name field is required."
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Admin not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="no admin record found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="something went wrong")
     *         )
     *     )
     * )
     */
    public function update()
    {
    }

    /**
     * @OA\Get(
     *     path="/api/admins/get",
     *     summary="Retrieve a paginated list of admins",
     *     description="Fetches a paginated list of admin records from the system.",
     *     operationId="getAdmins",
     *     tags={"Admins"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admins list retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="email", type="string", example="john.doe@example.com")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="last_page", type="integer", example=10),
     *                 @OA\Property(property="per_page", type="integer", example=5),
     *                 @OA\Property(property="total", type="integer", example=50)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="something went wrong")
     *         )
     *     )
     * )
     */
    public function get()
    {
        // Implementation here...
    }

    /**
     * @OA\Delete(
     *     path="/api/admins/delete/{admin}",
     *     summary="Delete an admin",
     *     description="Deletes an admin record.",
     *     operationId="deleteAdmin",
     *     tags={"Admins"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="admin",
     *         in="path",
     *         description="ID of the admin to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="_method",
     *         in="query",
     *         description="Request method override, should be 'delete'",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="delete"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Admin deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Admin deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Admin not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="no admin record found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="something went wrong")
     *         )
     *     )
     * )
     */
    public function delete()
    {
        // Implementation here...
    }
}
