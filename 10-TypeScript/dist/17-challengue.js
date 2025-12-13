"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
// 06-enums
var Categoria;
(function (Categoria) {
    Categoria["ELECTRONICA"] = "Electr\u00F3nica";
    Categoria["ROPA"] = "Ropa";
    Categoria["HOGAR"] = "Hogar";
})(Categoria || (Categoria = {}));
// 04-classes
class Inventario {
    constructor() {
        this.productos = [];
    }
    // 03-functions
    agregarProducto(producto) {
        if (producto.precio <= 0 || producto.cantidad < 0) {
            throw new Error('Precio debe ser positivo y cantidad no negativa.');
        }
        this.productos.push(producto);
    }
    obtenerProducto(id) {
        return this.productos.find(p => p.id === id);
    }
    // 12-utility-types + 07-advanced-types (Partial)
    actualizarProducto(id, cambios) {
        const index = this.productos.findIndex(p => p.id === id);
        if (index === -1)
            return false;
        this.productos[index] = Object.assign(Object.assign({}, this.productos[index]), cambios);
        return true;
    }
    listarProductos() {
        return [...this.productos]; // inmutabilidad
    }
    // 03-functions (eliminar producto)
    eliminarProducto(id) {
        const index = this.productos.findIndex(p => p.id === id);
        if (index === -1)
            return false;
        this.productos.splice(index, 1);
        return true;
    }
    // 13-async-await + 14-promises + 15-error-handling
    cargarInventarioSimulado() {
        return __awaiter(this, void 0, void 0, function* () {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    try {
                        this.agregarProducto({ id: 1, nombre: 'Laptop', precio: 1200, cantidad: 5 });
                        this.agregarProducto({ id: 2, nombre: 'Camiseta', precio: 25, cantidad: 20 });
                        this.agregarProducto({ id: 3, nombre: 'Mouse', precio: 15, cantidad: 30 });
                        this.agregarProducto({ id: 4, nombre: 'Teclado', precio: 45, cantidad: 15 });
                        this.agregarProducto({ id: 5, nombre: 'Monitor', precio: 300, cantidad: 8 });
                        resolve();
                    }
                    catch (err) {
                        reject(err);
                    }
                }, 300);
            });
        });
    }
}
// 05-generics (uso básico)
function buscarPorPropiedad(lista, clave, valor) {
    return lista.filter(item => item[clave] === valor);
}
