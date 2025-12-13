// 02-interfaces
interface Producto {
  id: number;
  nombre: string;
  precio: number;
  cantidad: number;
}

// 06-enums
enum Categoria {
  ELECTRONICA = 'Electrónica',
  ROPA = 'Ropa',
  HOGAR = 'Hogar',
}

// 04-classes
class Inventario {
  private productos: Producto[] = [];

  // 03-functions
  agregarProducto(producto: Producto): void {
    if (producto.precio <= 0 || producto.cantidad < 0) {
      throw new Error('Precio debe ser positivo y cantidad no negativa.');
    }
    this.productos.push(producto);
  }

  obtenerProducto(id: number): Producto | undefined {
    return this.productos.find(p => p.id === id);
  }

  // 12-utility-types + 07-advanced-types (Partial)
  actualizarProducto(id: number, cambios: Partial<Producto>): boolean {
    const index = this.productos.findIndex(p => p.id === id);
    if (index === -1) return false;

    this.productos[index] = { ...this.productos[index], ...cambios };
    return true;
  }

  listarProductos(): Producto[] {
    return [...this.productos]; // inmutabilidad
  }

  // 03-functions (eliminar producto)
  eliminarProducto(id: number): boolean {
    const index = this.productos.findIndex(p => p.id === id);
    if (index === -1) return false;
    this.productos.splice(index, 1);
    return true;
  }

  // 13-async-await + 14-promises + 15-error-handling
  async cargarInventarioSimulado(): Promise<void> {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        try {
          this.agregarProducto({ id: 1, nombre: 'Laptop', precio: 1200, cantidad: 5 });
          this.agregarProducto({ id: 2, nombre: 'Camiseta', precio: 25, cantidad: 20 });
          this.agregarProducto({ id: 3, nombre: 'Mouse', precio: 15, cantidad: 30 });
          this.agregarProducto({ id: 4, nombre: 'Teclado', precio: 45, cantidad: 15 });
          this.agregarProducto({ id: 5, nombre: 'Monitor', precio: 300, cantidad: 8 });
          resolve();
        } catch (err) {
          reject(err);
        }
      }, 300);
    });
  }
}

// 05-generics (uso básico)
function buscarPorPropiedad<T extends Record<string, any>>(
  lista: T[],
  clave: keyof T,
  valor: T[keyof T]
): T[] {
  return lista.filter(item => item[clave] === valor);
}

