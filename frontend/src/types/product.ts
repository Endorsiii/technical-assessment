export interface Product {
  product_id: number;
  product_name: string;
  product_type: string;
  product_parent_id: number | null;
  parent?: Product;
  children?: Product[];
}