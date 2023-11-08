<?php

namespace App\Http\Controllers\Api\V1\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     tags={"Записная книжка"},
 *     path="/api/v1/notes",
 *     summary="Получить список записей",
 *     description="Возвращает список записей с пагинацией",
 *     @OA\Parameter(
 *         in="query",
 *         name="page",
 *         description="Номер страницы пагинации",
 *         required=false,
 *         @OA\Schema(type="integer"),
 *         example=1
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", format="int64"),
 *                 @OA\Property(property="full_name", type="string"),
 *                 @OA\Property(property="company", type="string"),
 *                 @OA\Property(property="phone", type="string"),
 *                 @OA\Property(property="email", type="string"),
 *                 @OA\Property(property="birthday", type="string", format="date"),
 *                 @OA\Property(property="photo_uri", type="string")
 *             )),
 *             @OA\Property(property="links", type="object",
 *                 @OA\Property(property="first", type="string", format="uri"),
 *                 @OA\Property(property="last", type="string", format="uri"),
 *                 @OA\Property(property="prev", type="string", format="uri"),
 *                 @OA\Property(property="next", type="string", format="uri"),
 *             ),
 *             @OA\Property(property="meta", type="object",
 *                 @OA\Property(property="current_page", type="integer"),
 *                 @OA\Property(property="from", type="integer"),
 *                 @OA\Property(property="last_page", type="integer"),
 *                 @OA\Property(property="links", type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="url", type="string"),
 *                     @OA\Property(property="label", type="string"),
 *                     @OA\Property(property="active", type="boolean"), 
 *                 )),
 *                 @OA\Property(property="path", type="string", format="uri"),
 *                 @OA\Property(property="per_page", type="integer"),
 *                 @OA\Property(property="to", type="integer"),
 *                 @OA\Property(property="total", type="integer"),
 *             ),
 *             example={
 *                 "data": {
 *                     {
 *                         "id": 1,
 *                         "full_name": "Иванов Иван Иванович",
 *                         "company": "Рога и копыта",
 *                         "phone": "+79998887766",
 *                         "email": "ivanov@yandex.ru",
 *                         "birthday": "1965-07-28",
 *                         "photo_uri": "http://domain.com/images/photos/OdbIzkh7f1denb5i1S04ySvrqRFLggzZbwa6BZnW.jpg"
 *                     },
 *                     {
 *                         "id": 2,
 *                         "full_name": "Василий Петрович",
 *                         "company": null,
 *                         "phone": "+75554443322",
 *                         "email": "vasya@gmail.com",
 *                         "birthday": null,
 *                         "photo_uri": null
 *                     }
 *                 },
 *                 "links": {
 *                     "first": "http://domain.com/api/v1/notes?page=1",
 *                     "last": "http://domain.com/api/v1/notes?page=3",
 *                     "prev": null,
 *                     "next": "http://domain.com/api/v1/notes?page=2"
 *                 },
 *                 "meta": {
 *                     "current_page": 1,
 *                     "from": 1,
 *                     "last_page": 3,
 *                     "links": {
 *                         {
 *                             "url": null,
 *                             "label": "&laquo; Previous",
 *                             "active": false
 *                         },
 *                         {
 *                             "url": "http://domain.com/api/v1/notes?page=1",
 *                             "label": "1",
 *                             "active": true
 *                         },
 *                         {
 *                             "url": "http://domain.com/api/v1/notes?page=2",
 *                             "label": "2",
 *                             "active": false
 *                         },
 *                         {
 *                             "url": "http://domain.com/api/v1/notes?page=3",
 *                             "label": "3",
 *                             "active": false
 *                         },
 *                         {
 *                             "url": "http://domain.com/api/v1/notes?page=2",
 *                             "label": "Next &raquo;",
 *                             "active": false
 *                         }
 *                     },
 *                     "path": "http://domain.com/api/v1/notes",
 *                     "per_page": 2,
 *                     "to": 2,
 *                     "total": 5
 *                 }
 *             }
 *         )
 *     )
 * ),
 * 
 * @OA\Post(
 *     tags={"Записная книжка"},
 *     path="/api/v1/notes",
 *     summary="Создать новую запись",
 *     description="Возвращает данные созданной записи",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(type="object",
 *                 @OA\Property(property="full_name", description="ФИО", type="string"),
 *                 @OA\Property(property="company", description="Компания", type="string"),
 *                 @OA\Property(property="phone", description="Телефон", type="string"),
 *                 @OA\Property(property="email", description="Адрес эл.почты", type="string"),
 *                 @OA\Property(property="birthday", description="Дата рождения", type="string", format="date"),
 *                 @OA\Property(property="photo_file", description="Фото", type="string", format="binary")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="full_name", type="string", example="Иванов Иван Иванович"),
 *                 @OA\Property(property="company", type="string", example="Рога и копыта"),
 *                 @OA\Property(property="phone", type="string", example="+79998887766"),
 *                 @OA\Property(property="email", type="string", example="ivanov@yandex.ru"),
 *                 @OA\Property(property="birthday", type="string", format="date", example="1965-07-28"),
 *                 @OA\Property(property="photo_uri", type="string", example="http://domain.com/images/photos/OdbIzkh7f1denb5i1S04ySvrqRFLggzZbwa6BZnW.jpg"),
 *             )            
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Content",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="full_name", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="company", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="phone", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="email", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="birthday", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="photo_file", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 ))
 *             )
 *         )
 *     )
 * ),
 * 
 * @OA\Get(
 *     tags={"Записная книжка"},
 *     path="/api/v1/notes/{id}",
 *     summary="Получить определенную запись",
 *     description="Возвращает данные запрошенной записи",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         description="Номер записи",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *         example=1
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="full_name", type="string", example="Иванов Иван Иванович"),
 *                 @OA\Property(property="company", type="string", example="Рога и копыта"),
 *                 @OA\Property(property="phone", type="string", example="+79998887766"),
 *                 @OA\Property(property="email", type="string", example="ivanov@yandex.ru"),
 *                 @OA\Property(property="birthday", type="string", format="date", example="1965-07-28"),
 *                 @OA\Property(property="photo_uri", type="string", example="http://domain.com/images/photos/OdbIzkh7f1denb5i1S04ySvrqRFLggzZbwa6BZnW.jpg"),
 *             )
 *         ),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The note does not exist.")
 *         ),
 *     ),
 * ),
 * 
 * @OA\Put(
 *     tags={"Записная книжка"},
 *     path="/api/v1/notes/{id}",
 *     summary="Изменить определенную запись",
 *     description="Возвращает данные измененной записи",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         description="Номер записи",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *         example=1
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(type="object",
 *                 @OA\Property(property="full_name", description="ФИО", type="string"),
 *                 @OA\Property(property="company", description="Компания", type="string"),
 *                 @OA\Property(property="phone", description="Телефон", type="string"),
 *                 @OA\Property(property="email", description="Адрес эл.почты", type="string"),
 *                 @OA\Property(property="birthday", description="Дата рождения", type="string", format="date"),
 *                 @OA\Property(property="photo_file", description="Фото", type="string", format="binary"),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="full_name", type="string", example="Иванов Иван Иванович"),
 *                 @OA\Property(property="company", type="string", example="Рога и копыта"),
 *                 @OA\Property(property="phone", type="string", example="+79998887766"),
 *                 @OA\Property(property="email", type="string", example="ivanov@yandex.ru"),
 *                 @OA\Property(property="birthday", type="string", format="date", example="1965-07-28"),
 *                 @OA\Property(property="photo_uri", type="string", example="http://domain.com/images/photos/OdbIzkh7f1denb5i1S04ySvrqRFLggzZbwa6BZnW.jpg"),
 *             )            
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The note does not exist.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Content",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object",
 *                 @OA\Property(property="full_name", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="company", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="phone", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="email", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="birthday", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 )),
 *                 @OA\Property(property="photo_file", type="array",
 *                 @OA\Items(
 *                     @OA\Schema(type="string")
 *                 ))
 *             )
 *         )
 *     )
 * ),
 * 
 * @OA\Delete(
 *     tags={"Записная книжка"},
 *     path="/api/v1/notes/{id}",
 *     summary="Удалить определенную запись",
 *     description="Удаляет указанную запись и не возвращает никакого контента",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         description="Номер записи",
 *         required=true,
 *         @OA\Schema(type="integer"),
 *         example=1
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No Content"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The note does not exist.")
 *         ),
 *     )
 * )
 */
class NoteController extends Controller
{
}
